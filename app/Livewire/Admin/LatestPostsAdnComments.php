<?php

namespace App\Livewire\Admin;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class LatestPostsAdnComments extends Component
{
    public function render()
    {
        $latestPosts = Post::with('category')->withCount('comments')->whereStatus(1)->latest()->take(6)->get();
        $latestComments = Comment::with('user','post')->latest()->take(6)->get();
        return view('livewire.admin.latest-posts-adn-comments',[
            'latestComments'=>$latestComments,
            'latestPosts'=>$latestPosts,
        ]);
    }
}
