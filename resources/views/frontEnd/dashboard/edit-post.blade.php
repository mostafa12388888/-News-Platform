@extends('layouts.frontend.app')
@section('title')
    edit Post|{{ $post->title }}
@endsection
@section('body')
    <br />
    <br />
    <br />
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="/storage{{ auth()->user()->image }}" alt="User Image" class="rounded-circle mb-2"
                    style="width: 80px; height: 80px; object-fit: cover" />
                <h5 class="mb-0" style="color: #ff6f61"></h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{ rout('frontend.dashboard.profile') }}"
                    class="list-group-item list-group-item-action active menu-item" data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="/" class="list-group-item list-group-item-action menu-item" data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="{{ route('frontend.dashboard.setting') }}" class="list-group-item list-group-item-action menu-item"
                    data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content col-md-9">
            <!-- Show/Edit Post Section -->
            <form action="{{ route('frontend.dashboard.setting.update','$post->id') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <section id="posts-section" class="posts-section">
                    <h2>Your Posts</h2>
                    <ul class="list-unstyled user-posts">
                        <!-- Example of a Post Item -->
                        <li class="post-item">
                            <!-- Editable Title -->
                            <input type="hidden" name="id" value="{{ $post->id }}"
                                class="form-control mb-2 post-title" />
                            <input type="text" name="title" value="{{ $post->title }}"
                                class="form-control mb-2 post-title" />
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <!-- Editable Content -->
                            <textarea id="post-desc" class="form-control mb-2 post-content" name="desc">
                        {!! $post->desc !!}
                    </textarea>
                            @error('desc')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror


                            <!-- Image Upload Input for Editing -->
                            <input type="file" id="post-images" class="form-control mt-2 edit-post-image"
                                accept="image/*" multiple />

                            <!-- Editable Category Dropdown -->
                            <select class="form-control mb-2 post-category" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($post->category_id == $category->id)>{{ $category->name }}
                                    </option>
                                @endforeach

                            </select>
                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <!-- Editable Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input name="commentAble" class="form-check-input enable-comments"
                                    @checked($post->comment_able) type="checkbox" />
                                @error('comment_able')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <label class="form-check-label">
                                    Enable Comments
                                </label>
                            </div>

                            <!-- Post Meta: Views and Comments -->
                            <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                    <i class="fas fa-eye-fill"></i> {{ $post->number_of_views }}
                                </span>
                                <span class="post-comments">
                                    <i class="fas fa-chat"></i> {{ $post->comments->count() }}
                                </span>
                            </div>

                            <!-- Post Actions -->
                            <div class="post-actions mt-2">
                                <button class="btn btn-primary edit-post-btn">Edit</button>
                                <a href="" class="btn btn-danger delete-post-btn">Delete</a>
                                <button class="btn btn-success save-post-btn d-none">
                                    Save
                                </button>
                                <a href="{{route('frontend.dashboard.profile')}}" class="btn btn-secondary cancel-edit-btn d-none">
                                    Cancel
                                </a>
                            </div>

                        </li>
                        <!-- Additional posts will be added dynamically -->
                    </ul>
                </section>
            </form>
        </div>
    </div>
    <br />
    <br />
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

        $('#post-images').fileinput({
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
        $('#post-desc').summernote({
            height: 300,
        });
    </script>
@endpush
