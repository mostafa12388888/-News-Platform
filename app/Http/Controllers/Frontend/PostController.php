<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NewCommentNotify;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * show
     *
     * @param  mixed $slug
     * @return void
     */
    public function show($slug)
    {
        $mainPost = Post::with(['comments' => function ($query) {
            $query->limit(3);
        }])->whereSlug($slug)->first();
        if(is_null($mainPost))
        return view('errors.404');
        $category_posts = Post::where('category_id', $mainPost->category_id)->latest()->limit(5)->get();
        if(is_null($category_posts))
        return view('errors.404');
        $mainPost->increment('number_of_views');
        return view('frontEnd.show', compact('mainPost', 'category_posts'));
    }
    /**
     * getAllComments
     *
     * @param  mixed $slug
     * @return void
     */
    public function getAllComments($slug)
    {
        $post = Post::whereSlug($slug)->first();
        if(is_null($post))
        return view('errors.404');
        $comments = $post->comments()->with('user')->get();

        return response()->json($comments);
    }
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'postId' => 'required|exists:posts,id',
            'comment' => 'required|string|max:255',
        ]);
        $comment = Comment::create([
            'user_id' => $request->userId,
            'comment' => $request->comment,
            'post_id' => $request->postId,
            "ip_address" => $request->ip(),
        ]);
        $post = Post::findOrFail($request->postId);
        if (auth()->user()->id != $request->userId)
            $post->user->notify(new NewCommentNotify($comment, $post));

        if (!$comment) {
            return response()->json(['error' => 'operation failed', 'status' => 403]);
        }
        $comment->load('user');
        return response()->json([
            'msg' => 'comment stored successfully',
            'data' => $comment,

        ]);
    }
}
