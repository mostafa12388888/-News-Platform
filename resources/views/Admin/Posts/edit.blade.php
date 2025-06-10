@extends('layouts.dashboard.app')
@section('title')
    Update Post
@endsection
@section('body')
    <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">

        <h2 class="text-center">create New Post</h2>
        <br />

        @csrf
        @method('put')
        <div class="card-body shadow">
            <a style="margin-left:91ch" href="{{ route('admin.posts.index') }}" class="btn btn-primary">Show Posts</a>

            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <input type="text" value="{{ @old('title', $post->title) }}" name="title"
                            placeholder="enter post title" class="form-control">
                        @error('title')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>

                </div>
            </div>
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <textarea id="postContent" name="desc" placeholder="Enter post description" class="form-control">
                    {{ old('desc', $post->desc) }}
                </textarea>

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
                            <option value="1" @selected($post->status)>Active</option>
                            <option value="0" @selected(!$post->status)>un Active</option>
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
                            @foreach ($categories as $category)
                                <option @selected($post->category_id == $category->id) value="{{ $category->id }}">{{ $category->name }}
                                </option>
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
                            <option value="on" @selected($post->comment_able)>Active</option>
                            <option value="off" @selected(!$post->comment_able)>un Active</option>
                        </select>
                        @error('commentAble')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>

            </div>

            <button class="form-group btn btn-primary text-center" type="submit">Update Post</button>
        </div>
    </form>
@endsection
@push('js')
    <script>
        const initialPreview = [
            @if ($post->images->count())
                @foreach ($post->images as $image)
                    "{{ '/storage' . $image->path }}",
                @endforeach
            @endif
        ];

        $('#postImage').fileinput({
            enableResumableUpload: false,
            maxFileCount: 5,
            theme: 'fa5',
            allowedFileTypes: ['image'],
            showCancel: true,
            showUpload: false,
            initialPreview: initialPreview,
            initialPreviewAsData: true, // important to show images as thumbnails
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                @foreach ($post->images as $image)
                    {
                        caption: "{{ basename($image->path) }}",
                        key: "{{ $image->id }}",
                        url: "{{ route('frontend.dashboard.post.image.delete', $image->id) }}", // لو عندك route للحذف
                        extra: {
                            _token: "{{ csrf_token() }}"
                        }
                    },
                @endforeach
            ],

        });


        // Summer Note
        $('#postContent').summernote({
            height: 300,
        });
    </script>
@endpush
