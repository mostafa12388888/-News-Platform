<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Statics extends Component
{
    public function render()
    {
        $categoriesCount = Category::where('status', 1)->count();
        $postsCount = Post::where('status', 1)->count();
        $commentCount = Comment::count();
        $userCount = User::count();
        return view('livewire.admin.statics', [
            'userCount' => $userCount,
            'commentCount' => $commentCount,
            'postsCount' => $postsCount,
            'categoriesCount' => $categoriesCount,
        ]);
    }
}
