@extends('layouts.dashboard.app')
@section('title')
    Add Post
@endsection
@section('body')
    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">

        <h2  class="text-center">create New Post</h2>
        <br />

        @csrf
        <div class="card-body shadow">
        <a style="margin-left:91ch" href="{{route('admin.posts.index')}}" class="btn btn-primary">Show Posts</a>
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <input type="text" value="{{@old('title')}}" name="title" placeholder="enter post title" class="form-control">
                        @error('title')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>

                </div>
            </div>
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                    <textarea id="postContent" name="desc" placeholder="Enter post description" class="form-control">{{ old('desc') }}</textarea>

                        @error('desc')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <input type="file" id="postImage" name="images[]" multiple class="form-control">
                        @error('images')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">un Active</option>
                        </select>
                        @error('status')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
            <div class="col-6">
            <div class="form-group">
                <select name="categoryId" class="form-control">
                    <option disabled selected>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('categoryId')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>
                <div class="col-6">
                    <div class="form-group">
                        <select name="commentAble" class="form-control">
                            <option disabled selected>Select Comment Able Status</option>
                            <option value="on">Active</option>
                            <option value="off">un Active</option>
                        </select>
                        @error('commentAble')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>

            </div>

            <button class="form-group btn btn-primary text-center" type="submit">Add Post</button>
        </div>
    </form>
@endsection
@push('js')
    <script>
        $(function() {
            $("#postImage").fileinput({
                enableResumableUpload: false,
                maxFileCount: 5,
                theme: 'fa5',
                allowedFileTypes: ['image'], // allow only images
                showCancel: true,
                showUpload: false,
            });

        });

        $('#postContent').summernote({
            height: 300,
        });
    </script>
@endpush
