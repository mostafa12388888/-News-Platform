@extends('layouts.dashboard.app')
@section('title')
    posts Page
@endsection
@section('body')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Posts</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Posts Management</h6>
            </div>
            @include('Admin.Posts.Filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>User</th>
                                <th>Category</th>
                                <th>Number of Views</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>User</th>
                                <th>Category</th>
                                <th>Number of Views</th>
                                <th>Status</th>

                                <th>Action</th>

                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->user?->name ?? $post->admin?->name }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->number_of_views }}</td>

                                    <td class="text-{{ $post->status ? 'black' : 'danger' }}">
                                        {{ $post->status ? 'active' : 'Not Active' }}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('are you sure delete :{{ $post->name }}'))document.getElementById('deletepost{{ $post->id }}').submit()"
                                            class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></a>
                                        <a href="{{ route('admin.post.status', $post->id) }}" class="btn btn-danger"
                                            type="submit"><i
                                                class="fa fa-{{ $post->status ? 'check-circle' : 'ban' }}"></i></a>
                                        <a href="{{ route('admin.posts.show', ['post' => $post->id, 'page' => request()->page]) }}"
                                            class="btn btn-info" type="submit"><i class="fa fa-eye"></i></a>
                                        @if (is_null($post->user_id))
                                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-info"
                                                type="submit"><i class="fa fa-edit"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                <form id="deletepost{{ $post->id }}"
                                    action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6"> you don't have any post</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                    {{ $posts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
