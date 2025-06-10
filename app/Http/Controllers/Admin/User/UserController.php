<?php

namespace App\Http\Controllers\Admin\User;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $users = User::when($request->keyword, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        })
            ->when(!is_null($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy($request->searchValue ?? 'id', $request->order ?? 'desc')
            ->paginate($request->number ?? 10);

        return view('Admin.Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $file = FileHelper::uploadFile($request->image, 'userImage');
        $user = User::create([
            'name' => $request->name,
            'user_name' => $request->userName,
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
            'phone' => $request->phone,
            'image' => $file,
            "email_verified_at" => $request->emailVerifiedAt ? now() : null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Session::flash('success', 'User Created Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('Admin.Users.show', compact('user'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        FileHelper::deleteFile('/storage' . $user->image);
        $user->delete();
        Session::flash('success', 'deleted has been successfully');
        return redirect()->route('admin.user.index');
    }
    public function statusChange($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => $user->status ? 0 : 1]);
        Session::flash('success', 'User updated has been successfully');
        return redirect()->back();
    }
}
