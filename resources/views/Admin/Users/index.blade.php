@extends('layouts.dashboard.app')
@section('title')
    users Page
@endsection
@section('body')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Management</h6>
            </div>
@include('Admin.Users.Filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-{{ $user->status ? 'black' : 'danger' }}">
                                        {{ $user->status ? 'active' : 'Not Active' }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="if(confirm('are you sure delete :{{$user->name}}'))document.getElementById('deleteUser{{$user->id}}').submit()" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></a>
                                        <a href="{{route('admin.user.status',$user->id)}}" class="btn btn-danger" type="submit"><i class="fa fa-{{$user->status?'check-circle' : 'ban' }}"></i></a>
                                        <a href="{{route('admin.users.show',$user->id)}}" class="btn btn-info" type="submit"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                <form id="deleteUser{{$user->id}}" action="{{route('admin.users.destroy',$user->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                </form>
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6"> you don't have any User</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                    {{$users->appends(request()->input())->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
