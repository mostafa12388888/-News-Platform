@extends('layouts.frontend.app')
@section('title')
    Notification
@endsection
@section('body')
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontEnd.dashboard._sidebar', ['notificationActive' => 'active'])

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>

                    </div>
                    <div class="col-6 d-flex justify-content-end" style="height: 2rem;">
                        <a href="{{ route('frontend.dashboard.notification.delete.all') }}" class="btn btn-sm btn-danger">
                            Delete All
                        </a>
                    </div>

                </div>
                @auth
                    @forelse (auth()->user()->notifications as $netlify)
                        <a href="{{ $netlify->data['link'] }}?notify={{ $netlify->id }}">
                            <div class="notification alert alert-info">
                                <strong>you have Notification From: {{ $netlify->data['user_name'] }}!</strong> post title:
                                {{ $netlify->data['post_title'] }}.
                                <br />
                                {{ $netlify->created_at->diffForHumans() }}
                                <div class="float-right">
                                    <button
                                        onclick="if(confirm('are you sure delete Notify ?')) {
                document.getElementById('deleteNotification{{ $netlify->id }}').submit()
                } return false;"
                                        class="btn btn-danger btn-sm">Delete</button>
                                </div>
                            </div>
                        </a>
                        <form id="deleteNotification{{ $netlify->id }}"
                            action="{{ route('frontend.dashboard.notification.delete') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $netlify->id }}">
                        </form>
                    @empty
                        <div class="alert alert-info"> No any Notifications!! </div>
                    @endforelse
                @endauth
            </div>
        </div>
    </div>
    <!-- Dashboard End-->
@endsection
