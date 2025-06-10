<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::when($request->keyword, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        })
            ->when(!is_null($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy($request->searchValue ?? 'id', $request->order ?? 'desc')
            ->paginate($request->number ?? 10);

        return view('Admin.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "status" => "required|in:1,0"
        ]);
        Category::create([
            "name" => $request->name,
            "status" => $request->status,
        ]);
        Session::flash('success', 'Category Created has been successfully');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|string",
            "status" => "required|in:1,0"
        ]);
        Category::findOrFail($id)->update([
            "name" => $request->name,
            "status" => $request->status,
        ]);
        Session::flash('success', 'Category Updated has been successfully');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash('success', 'deleted has been successfully');
        return redirect()->route('admin.categories.index');
    }
    public function statusChange($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['status' => $category->status ? 0 : 1]);
        Session::flash('success', 'Category updated has been successfully');
        return redirect()->back();
    }
}
