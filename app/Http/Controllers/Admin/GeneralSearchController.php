<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class GeneralSearchController extends Controller
{
    public  function search(Request $request)
    {
        $paginate = 10;

        if ($request->option == "post") {
            $posts = Post::where('title', 'LIKE', '%' . $request->keyword . '%')->paginate($paginate);
            return view('Admin.Posts.index', compact('posts'));
        } elseif ($request->option == "category") {
            $categories = Category::where('name', 'LIKE', '%' . $request->keyword . '%')->paginate($paginate);
            return view('Admin.Categories.index', compact('categories'));
        } elseif ($request->option == "user") {
            $users = User::where('name', 'LIKE', '%' . $request->keyword . '%')->paginate($paginate);
            return view('Admin.Users.index', compact('users'));
        } elseif ($request->option == "contact") {
            $contacts = Contact::where('name', 'LIKE', '%' . $request->keyword . '%')->paginate($paginate);
            return view('Admin.Contacts.index', compact('contacts'));
        }
        return redirect()->back();
    }
}
