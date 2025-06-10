<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\dashboard\CreatePostRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->post()->active()->with(['images'])->latest()->get();
        return view('frontEnd.dashboard.profile', compact('posts'));
    }
    public function storePost(CreatePostRequest $request)
    {

        try {
            DB::beginTransaction();
            $dataImage = [];
            $now = Carbon::now();

            $post = Post::create([
                'user_id' => auth('web')->user()->id,
                'category_id' => $request->categoryId,
                'status',
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
    public function editPost($slug)
    {
        $post = Post::with('images')->where('slug', $slug)->first();
        return view('frontEnd.dashboard.edit-post', compact('post'));
    }

    public function updatePost(CreatePostRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataImage = [];
            $now = Carbon::now();
            $post = Post::findOrFail($request->id);
            $post->update([
                'category_id' => $request->categoryId,
                'comment_able' => $request->commentAble == "on" ? 1 : 0,
                'desc' => $request->desc,
                'title' => $request->title,
            ]);
            if ($request->hasFile('images')) {
                if ($post->images->count()) {
                    foreach ($post->images as $image)
                        FileHelper::deleteFile('/storage' . $image->path);
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
     * deletePost
     *
     * @param  mixed $request
     * @return void
     */
    public function deletePost(Request $request)
    {
        $post = Post::findOrFail($request->postId);
        if ($post->images->count()) {
            foreach ($post->images as $image)
                FileHelper::deleteFile('/storage' . $image->path);
        }
        $post->delete();
        session()->flash('success', 'delete successfully');
        return redirect()->back();
    }
    /**
     * getComments
     *
     * @param  mixed $id
     * @return void
     */
    public function getComments($id)
    {
        $comment = Comment::with(['user'])->where('post_id', $id)->get();
        if (!$comment)
            return response()->json([
                'data' => null,
                'message' => 'No comments'
            ]);
        return response()->json([
            'data' => $comment,
            'message' => 'those you have comments',
        ]);
    }
    public function deleteImagePost(Request $request, $image_id)
    {
        $image = Image::findOrFail($image_id);
        FileHelper::deleteFile('/storage' . $image->path);

        $image->delete();
    }
}
