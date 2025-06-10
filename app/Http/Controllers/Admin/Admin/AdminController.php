<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminRequest;
use App\Http\Requests\Admin\Admin\updateAdminRequest;
use App\Models\Admin;
use App\Models\Authorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admins = Admin::where('id', '!=', auth()->guard('admin')->user()->id)->when($request->keyword, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        })
            ->when(!is_null($request->status), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy($request->searchValue ?? 'id', $request->order ?? 'desc')
            ->paginate($request->number ?? 10);

        return view('Admin.Admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authorization = Authorization::select('id', 'role')->get();
        return view('Admin.Admins.add', compact('authorization'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $user = Admin::create([
            'name' => $request->name,
            'user_name' => $request->userName,
            'email' => $request->email,
            'status' => $request->status,
            'password' => Hash::make($request->password),
            "role_id" => $request->role,
        ]);
        Session::flash('success', 'Admin Created Successfully');
        return redirect()->route('admin.admins.index');
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
        $admin = Admin::findOrFail($id);
        $authorization = Authorization::select('id', 'role')->get();
        return view('Admin.Admins.edit', compact('admin', 'authorization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateAdminRequest $request, string $id)
    {
       $admin= Admin::findOrFail($id);
       $admin->update([
            'name' => $request->name,
            'user_name' => $request->userName,
            'email' => $request->email,
            'status' => $request->status,
            'password' => $request->password?Hash::make($request->password):$admin->password,
            "role_id" => $request->role,
        ]);
        Session::flash('success', 'Admin Updated Successfully');
        return redirect()->route('admin.admins.index');
    }

    public function destroy(string $id)
    {
        Admin::findOrFail($id)->delete();
        Session::flash('error', 'Admin Deleted has been successfully');
        return redirect()->route('admin.admins.index');
    }
    public function statusChange($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update(['status' => $admin->status ? 0 : 1]);
        Session::flash('success', 'Admin Change Status has been successfully');
        return redirect()->back();
    }
}
