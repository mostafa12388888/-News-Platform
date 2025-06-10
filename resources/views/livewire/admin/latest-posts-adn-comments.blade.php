<div>
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Last Posts</h6>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>title</th>
                                <th>category</th>
                                <th>comments</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestPosts as $post)
                                @can('posts')
                                    <tr>
                                        <td> <a
                                                href="{{ route('admin.posts.show', $post->id) }}">{{ Str::limit($post->title, 10) }}</a>
                                        </td>
                                        <td> <a href="{{ route('admin.posts.show', $post->id) }}">
                                                {{ $post->category->name }}
                                            </a>
                                        </td>
                                        <td> <a
                                                href="{{ route('admin.posts.show', $post->id) }}">{{ $post->comments_count }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.posts.show', $post->id) }}">
                                                {{ $post->status ? 'Active' : 'Not Active' }}
                                            </a>
                                        </td>
                                    </tr>
                                @endcan
                                @cannot('posts')
                                    <tr>
                                        <td>{{ Str::limit($post->title, 10) }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td>{{ $post->comments_count }}</td>
                                        <td>{{ $post->status ? 'Active' : 'Not Active' }}</td>
                                    </tr>
                                @endcannot
                            @empty
                                <p>there is Not Posts</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Last Comment</h6>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Post</th>
                                <th>comments</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestComments as $comment)
                                <tr>
                                    <td>{{ $comment->user->user_name }}</td>
                                    <td>
                                        @can('posts')
                                            <a href="{{ route('admin.posts.show', $comment->post->id) }}">

                                            </a>
                                        @endcan
                                        @cannot('posts')
                                            {{ $comment->post->title }}
                                        @endcannot

                                    </td>
                                    <td>{{ Str::limit($comment->comment, 40) }}</td>
                                    <td>{{ $comment->status ? 'Active' : 'Not Active' }}</td>
                                </tr>
                            @empty
                                <p>there is Not Any Comment</p>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>



        </div>


    </div>
</div>
