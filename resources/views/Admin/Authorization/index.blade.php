@extends('layouts.dashboard.app')
@section('title')
    Roles Page
@endsection
@section('body')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Roles Margent</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Roles Management</h6>
            </div>
            <br>
            <div class="card-header py-3">
            <a href="{{route('admin.authorization.create')}}" class="btn btn-primary">Create New Role</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Permission</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Role Name</th>
                                <th>Permission</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($authorizations as $authorization)
                                <tr>
                                    <td>{{ $authorization->role }}</td>
                                    <td>
                                        @foreach ($authorization->permission as $per)
                                            {{ $per }},
                                        @endforeach
                                    </td>
                                    <td>{{ $authorization->created_at }}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('are you sure delete :{{ $authorization->name }}'))document.getElementById('deleteauthorization{{ $authorization->id }}').submit()"
                                            class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></a>

                                        <a href="{{ route('admin.authorization.edit', $authorization->id) }}" class="btn btn-info"
                                            type="submit"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <form id="deleteauthorization{{ $authorization->id }}"
                                    action="{{ route('admin.authorization.destroy', $authorization->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6"> you don't have any authorization</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                    {{ $authorizations->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
