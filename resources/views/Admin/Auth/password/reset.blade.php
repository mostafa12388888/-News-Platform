@extends('layouts.dashboard.auth.app')
@section('title')
    reset Password
@endsection
@section('body')
    <!-- Outer Row -->
    <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Enter New Password!</h1>
                            </div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                            <form action="{{ route('admin.password.reset') }}" class="user">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" value="{{$emil}}" class="form-control form-control-user" id="exampleInputEmail"
                                        name="email" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" name="password" placeholder="Password">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputpassword_confirmation" name="password_confirmation" placeholder="password_confirmation">
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Reset
                                </button>
                            </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
