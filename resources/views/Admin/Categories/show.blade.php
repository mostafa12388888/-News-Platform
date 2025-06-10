@extends('layouts.dashboard.app')
@section('title')
    Add User
@endsection
@section('body')
    <h2 class="text-center">Show User : {{ $user->name }}</h2>
    <br />

    <div class="card-body shadow">
        <div class="row">

            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Name: {{ $user->name }}" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="User Name: {{ $user->user_name }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Email: {{ $user - email }}" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Phone : {{ $user->phone }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Status : {{ $user->status ? 'Active' : 'UN Active' }}" class="form-control">

                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="{{ !is_null($user->email_verified_at) ? 'verified' : 'Not verified' }}"
                        class="form-control">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Country : {{ $user->country }}" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="City : {{ $user->city }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input disabled value="Street : {{ $user->street }}" class="form-control">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <img src="/storage{{ $user->image }}" alt="{{ $user->name }}" srcset="" class="img-thumbnail">
                </div>
            </div>

        </div>
        <br />
        <a href="javascript:void(0)"
            onclick="if(confirm('are you sure delete :{{ $user->name }}'))document.getElementById('deleteUser').submit()"
            class="btn btn-primary">{{$user->status?"Block":"Active"}}</a>
        <a href="{{ route('admin.user.status', $user->id) }}" class="btn btn-info">Delete</a>
        <form id="deleteUser" action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection
