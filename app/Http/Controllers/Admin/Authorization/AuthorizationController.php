<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Authorization\AuthorizationRequest;
use App\Models\Authorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authorizations = Authorization::Paginate(10);
        return view('Admin.Authorization.index', compact('authorizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Authorization.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorizationRequest $request)
    {

        Authorization::create([
            "role" => $request->role,
            "permission" => json_encode($request->permissions),
        ]);
        Session::flash('success', 'Permission Store succfully');
        return redirect()->route('admin.authorization.index');
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
        $authorizations = Authorization::findOrFail($id);
        return view('Admin.Authorization.edit', compact('authorizations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $authorizations = Authorization::findOrFail($id);
        $authorizations->update([
            "role" => $request->role,
            "permission" => json_encode($request->permissions),
        ]);
        Session::flash('success', 'Permission update succfully');
        return redirect()->route('admin.authorization.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Authorization::findOrFail($id);
        if ($role->admins()->count()) {
            Session::flash('error', "Permission Can't Not Deleted,Because There is Admins Related for this Role");
            return redirect()->back();
        }

        $role->delete();
        Session::flash('success', 'Permission Deleted succfully');
        return redirect()->route('admin.authorization.index');
    }
}
