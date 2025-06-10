@extends('layouts.dashboard.app')
@section('title')
    categories Page
@endsection
@section('body')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category Management</h6>
            </div>
            @include('Admin.categories.Filter.filter')
            <!-- table data -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Posts Count</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Posts Count</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-{{ $category->status ? 'black' : 'danger' }}">
                                        {{ $category->status ? 'active' : 'Not Active' }}</td>
                                    <td>{{ $category->posts_count }}</td>

                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('are you sure delete :{{ $category->name }}'))document.getElementById('deleteCategory{{ $category->id }}').submit()"
                                            class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></a>
                                        <a href="{{ route('admin.category.status', $category->id) }}"
                                            class="btn btn-danger" type="submit"><i
                                                class="fa fa-{{ $category->status ? 'check-circle' : 'ban' }}"></i></a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#editCategory{{ $category->id }}">
                                            <i class="fa fa-pin"></i>
                                        </button>

                                    </td>
                                </tr>
                                <!-- Button trigger modal -->

                                <!-- Modal -->

                                @include('Admin.Categories.edit')
                                <form id="deleteCategory{{ $category->id }}"
                                    action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6"> you don't have any Category</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                    {{ $categories->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
        <!-- module at New Category -->
        <!-- Button trigger modal -->


        <!-- Modal -->
        @include('Admin.Categories.crate')
    </div>
    <!-- /.container-fluid -->
@endsection
