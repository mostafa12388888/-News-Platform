@extends('layouts.dashboard.app')
@section('title')
    Add User
@endsection
@section('body')
    <h2 class="text-center">Show Post : {{ $post->title }}</h2>
    <br />

    <div class="m-auto  card-body shadowcol-lg-8" style="word-wrap: break-word; overflow-wrap: break-word; max-width:100ch">
        <a href="{{ route('admin.posts.index', ['page' => request()->page]) }}" class="btn btn-primary">Back TO Posts</a>
        <br />
        <br />
        <div id="newsCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#newsCarousel" data-slide-to="1"></li>
                <li data-target="#newsCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @foreach ($post->images as $image)
                    <div class="carousel-item @if ($loop->index == 0) active @endif">
                        <img src="{{ '/storage' . $image->path }}" class="d-block w-100" alt="{{ $post->title }}">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $post->name }}</h5>
                            <p>
                                {{ Str::limit(strip_tags($post->desc), 80) }}
                            </p>
                        </div>
                    </div>
                @endforeach
                <!-- Add more carousel-item blocks for additional slides -->
            </div>
            <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="alert alert-info">
            {{ $post->user->name ?? $post->admin->name }}<i class="fa fa-user"></i>
        </div>
        <div class="row">
            <div class="col-4">
                <h4>VIews : {{ $post->number_of_views }}<i class="fa fa-eye"></i></h4>
            </div>

            <div class="col-4">
                <h6> Created At : {{ $post->created_at->format('Y-m-d h:m') }} <i class="fa fa-edit"></i>
                </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h6>comments : {{ $post->comment_able ? 'Active' : 'Not Active' }}</h6>
            </div>
            <div class="col-4">
                <h6>status : {{ $post->status ? 'Active' : 'Not Active' }} <i
                        class="fa fa-{{ $post->status ? 'wifi' : 'plane' }}"></i></h6>
            </div>
            <div class="col-4">
                <h6>Category : {{ $post->category->name }} <i class="fa fa-folder"></i></h6>
            </div>
        </div>
        <div class="sn-content">
            <p> {!! chunk_split($post->desc, 70) !!}</p>
        </div>

        <br />

    </div>
    <div>
        <a href="javascript:void(0)"
            onclick="if(confirm('are you sure delete :{{ $post->name }}'))document.getElementById('deletepost{{ $post->id }}').submit()"
            class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></a>
        <a href="{{ route('admin.post.status', $post->id) }}" class="btn btn-primary" type="submit"><i
                class="fa fa-{{ $post->status ? 'check-circle' : 'ban' }}"></i></a>
        @if (is_null($post->user_id))
            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-info" type="submit"><i
                    class="fa fa-edit"></i></a>
        @endif
        <form id="deletepost{{ $post->id }}" action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>










        <!-- show  comments  -->

        <!-- Dashboard Start-->
        <div class="dashboard container">
            <!-- Sidebar -->
            <!-- Main Content -->
            <div class="main-content">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="mb-4">Comments</h2>

                        </div>
                    </div>
                    @forelse ($post->comments as $comment)
                        <div class="notification alert alert-info">
                            <strong><img src="{{ 'storage/' . $comment->user->image }}" class="img-thumbnail rounded"
                                    alt="{{ $comment->user->name }}"> <a style="text-decoration: none;"
                                    href="{{ route('admin.users.show', $comment->user->id) }}">{{ $comment->user->name }}</a>
                                : </strong> {{ $comment->comment }}
                            <br />
                            <span style="color: red;"> {{ $comment->created_at->diffForHumans() }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('admin.comment.delete', $comment->id) }}"
                                    class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </div>

                    @empty
                        <div class="alert alert-info"> No Comment yet!! </div>
                    @endforelse
                @endauth
            </div>
        </div>
    </div>
    <!-- Dashboard End-->








</div>

<br />
@endsection
