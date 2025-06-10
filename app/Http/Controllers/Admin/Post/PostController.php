<?php

namespace App\Http\Controllers\Admin\Post;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\dashboard\CreatePostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:posts');
        $this->middleware('can:index_posts')->only('index');
        $this->middleware('can:status_posts')->only('statusChange');
        $this->middleware('can:store_posts')->only(['store','create']);
        $this->middleware('can:update_posts')->only(['edit','update']);
        $this->middleware('can:delete_posts')->only('destroy');
        $this->middleware('can:show_posts')->only('show');

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $posts = post::when($request->keyword, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%');
            });
        })
            ->when(!is_null($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy($request->searchValue ?? 'id', $request->order ?? 'desc')
            ->paginate($request->number ?? 10);

        return view('Admin.Posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', '1')->select('id', 'name')->get();
        return view('Admin.Posts.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataImage = [];
            $now = Carbon::now();

            $post = Post::create([
                'admin_id' => auth()->user()->id,
                'category_id' => $request->categoryId,
                'status' => $request->status,
                'comment_able' => $request->commentAble == "on" ? 1 : 0,
                'desc' => $request->desc,
                'title' => $request->title,

            ]);
            foreach ($request->images as $image)
                $dataImage[] = [
                    'post_id' => $post->id,
                    'path' => FileHelper::uploadFile($image, 'PostImage'),
                    'created_at' => $now,
                    'updated_at' => $now,

                ];
            Image::insert($dataImage);
            DB::commit();
            Cache::forget('readMorePosts');
            Cache::forget('latestPost');
            Session::flash('success', 'your post created successfully');

            return redirect()->back();
        } catch (\Exception $error) {
            DB::rollBack();
            Session::flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('comments','comments.user')->findOrFail($id);
        return view('Admin.Posts.show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('Admin.Posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePostRequest $request, string $id)
    {

        try {
            DB::beginTransaction();
            $dataImage = [];
            $now = Carbon::now();
            $post = Post::findOrFail($id);
            $post->update([
                'category_id' => $request->categoryId,
                'status' => $request->status,
                'comment_able' => $request->commentAble == "on" ? 1 : 0,
                'desc' => $request->desc,
                'title' => $request->title,
            ]);
            if ($request->hasFile('images')) {
                if ($post->images->count()) {

                    foreach ($post->images as $imageModel)
                        FileHelper::deleteFile('/storage' . $imageModel->path);
                }
                foreach ($request->images as $image)
                    $dataImage[] = [
                        'post_id' => $post->id,
                        'path' => FileHelper::uploadFile($image, 'PostImage'),
                        'created_at' => $now,
                        'updated_at' => $now,

                    ];
                Image::insert($dataImage);
            }
            DB::commit();
            Cache::forget('readMorePosts');
            Cache::forget('latestPost');
            Session::flash('success', 'your post created successfully');

            return redirect()->back();
        } catch (\Exception $error) {
            DB::rollBack();
            Session::flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post->images->count())
            foreach ($post->images as $image)
                FileHelper::deleteFile('/storage' . $image->path);

        $post->delete();
        Session::flash('success', 'deleted has been successfully');
        return redirect()->route('admin.posts.index');
    }
    public function statusChange($id)
    {
        $post = post::findOrFail($id);
        $post->update(['status' => $post->status ? 0 : 1]);
        Session::flash('success', 'post updated has been successfully');
        return redirect()->back();
    }
    public function deleteComment($id){
        $comment=Comment::findOrFail($id);
        $comment->delete();
        Session::flash('success', 'deleted has been successfully');
        return redirect()->back();
    }
}
