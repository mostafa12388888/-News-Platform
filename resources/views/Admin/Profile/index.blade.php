@extends('layouts.dashboard.app')
@section('title')
    Profile
@endsection

@section('body')
    <form action="{{ route('admin.profile.update') }}" method="post">

        <h2 class="text-center">Update Profile</h2>
        <br />

        @csrf
        <div class="card-body shadow">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <label for="name">Enter your Name</label>

                        <input id="name" type="text" value="{{ auth('admin')->user()->name }}" name="name"
                            placeholder="enter your Name" class="form-control">
                        @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                    <label for="userName">Enter your Username</label>

                        <input id="userName" type="text" value="{{ auth('admin')->user()->user_name }}" name="username"
                            placeholder="enter user_name Setting" class="form-control">
                        @error('user_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                    <label for="email">Enter your email</label>

                        <input type="email" id="email" value="{{ auth('admin')->user()->email }}" name="email"
                            placeholder="enter user email" class="form-control">
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <label for="password">Enter your Password</label>
                        <input id="password" type="text" name="password" placeholder="Enter your Password confirm" class="form-control">
                        @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="form-group btn btn-primary" type="submit">Update Profile</button>
        </div>
    </form>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>
@endpush
