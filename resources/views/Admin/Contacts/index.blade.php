@extends('layouts.dashboard.app')
@section('title')
    Contact Page
@endsection
@section('body')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Contacts</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contact Management</h6>
            </div>
@include('Admin.Contact.Filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>title</th>
                                <th>status</th>
                                <th>body</th>
                                <th>phone</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>title</th>
                                <th>status</th>
                                <th>body</th>
                                <th>phone</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->title }}</td>
                                    <td>{{ $contact->status?"Read":"Un Read" }}</td>
                                    <td>{{ $contact->body }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="if(confirm('are you sure delete :{{$user->name}}'))document.getElementById('deleteUser{{$user->id}}').submit()" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></a>
                                        <a href="{{route('admin.contacts.show',$user->id)}}" class="btn btn-info" type="submit"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                <form id="deleteUser{{$user->id}}" action="{{route('admin.contacts.destroy',$user->id)}}" method="POST">
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
                    {{$contacts->appends(request()->input())->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
