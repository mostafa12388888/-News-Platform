@extends('layouts.dashboard.app')
@section('title')
    Add User
@endsection
@section('body')
    <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">

        <h2 class="text-center">create New User</h2>
        <br />

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
                        <input type="text" name="userName" placeholder="enter user name" class="form-control">
                        @error('userName')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="email" placeholder="enter user email" class="form-control">
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="enter user phone" class="form-control">
                        @error('phone')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <Select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">un Active</option>
                        </Select>
                        @error('status')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <Select name="emailVerifiedAt" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">un Active</option>
                        </Select>
                        @error('emailVerifiedAt')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="country" placeholder="enter  country Name" class="form-control">
                        @error('country')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" name="city" placeholder="enter  city Name" class="form-control">
                        @error('city')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">

                        <input type="text" name="street" placeholder="enter  street Name" class="form-control">
                        @error('street')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                    <input type="file" name="image" accept="image/*" class="form-control">
                    @error('image')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="password" name="password" placeholder="enter user password" class="form-control">
                        @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="password" name="password_confirmation" placeholder="enter user confirm password"
                            class="form-control">
                        @error('password_confirmation')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="form-group btn btn-primary" type="submit">Add User</button>
        </div>
    </form>
@endsection
