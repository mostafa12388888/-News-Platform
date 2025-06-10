@extends('layouts.dashboard.app')
@section('title')
    Notifications
@endsection
@section('body')
    <div class="dashboard container">
        <!-- Sidebar -->
        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>

                    </div>
                    <div class="col-6">
<a href="{{route('admin.notification.delete-all')}}" class="btn btn-danger" style="margin-left: 32ch;">Delete All</a>
                    </div>
                </div>
                @forelse ($notifications as $notify)
                    <div class="notification alert alert-info">
                        <strong>
                            <a style="text-decoration: none;"
                                href="{{ $notify->data['link'] }}?notify-admin={{ $notify->id }}">{{ $notify->data['user_name'] }}</a>
                            : </strong> {{ $notify->data['contact_title'] }}
                        <br />
                        <span style="color: red;"> {{ $notify->data['created_at']->diffForHumans() }}
                        </span>
                        <div class="float-right">
                            <a href="{{ route('admin.notification.delete', $notify->id) }}"
                                class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>

                @empty
                    <div class="alert alert-info"> No Comment yet!! </div>
                @endforelse
            @endauth
        </div>
    </div>
@endsection
