<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $category = Category::whereSlug($slug)->first();
        if(is_null($category))
        return view('errors.404');
        $posts = $category->posts()->latest()->paginate(9);
        return view('frontEnd.category_posts', compact('posts','category'));
    }
}
