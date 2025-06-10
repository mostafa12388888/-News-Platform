@extends('layouts.dashboard.app')
@section('title')
    Add Admin
@endsection
@section('body')
    <form action="{{ route('admin.admins.store') }}" method="post" enctype="multipart/form-data">

        <div class="row">
            <div class="col-9">
                <h2 class="text-center">create New Admin</h2>

            </div>
            <div class="col-3">
                <a href="{{ route('admin.admins.index') }}" class="btn btn-primary">Back to Admins</a>

            </div>
        </div> <br />

        @csrf
        <div class="card-body shadow">


            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="name" class="form-control">
                        @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="userName" placeholder="enter Admin name" class="form-control">
                        @error('userName')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="email" placeholder="enter Admin email" class="form-control">
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                    Select Status : <Select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">un Active</option>
                        </Select>
                        @error('status')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                    Select Role : <Select name="role" class="form-control">
                        @foreach ($authorization as $auth )
                        <option value="{{$auth->id}}">{{$auth->role}}</option>
                        @endforeach
                       </Select>
                        @error('role')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="password" name="password" placeholder="enter Admin password" class="form-control">
                    @error('password')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="enter Admin confirm password"
                        class="form-control">
                    @error('password_confirmation')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        </div>
        <button class="form-group btn btn-primary" type="submit">Add Admin</button>
        </div>
    </form>
@endsection
