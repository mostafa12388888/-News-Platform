@extends('layouts.dashboard.app')
@section('title')
    Setting
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('body')
    <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">

        <h2 class="text-center">Update Setting</h2>
        <br />

        @csrf
        <div class="card-body shadow">
            <div class="row">
                <input type="hidden" name="settingId" value="{{ $getSettings->id }}">

                <div class="col-6">
                    <div class="form-group">
                    <label for="site_name">Site name</label>

                        <input id="site_name" type="text" value="{{ $getSettings->site_name }}" name="site_name"
                            placeholder="enter your Site Name" class="form-control">
                        @error('site_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                    <label for="phone">Phone</label>

                        <input type="text" value="{{ $getSettings->phone }}" name="phone"
                            placeholder="enter phone Setting" class="form-control">
                        @error('phone')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                    <label for="email">Email</label>

                        <input id="email" type="email" value="{{ $getSettings->email }}" name="email"
                            placeholder="enter user email" class="form-control">
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" value="{{ $getSettings->country }}" name="country"
                            placeholder="enter site country" class="form-control">
                        @error('country')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <input type="text" value="{{ $getSettings->city }}" name="city" placeholder="enter site city"
                            class="form-control">
                        @error('city')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" value="{{ $getSettings->street }}" name="street"
                            placeholder="enter site street" class="form-control">
                        @error('street')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">

                        <input type="text" value="{{ $getSettings->facebook }}" name="facebook"
                            placeholder="enter  facebook Name" class="form-control">
                        @error('facebook')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">

                        <input type="text" value="{{ $getSettings->youtube }}" name="youtube"
                            placeholder="enter  youtube Name" class="form-control">
                        @error('youtube')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">

                        <input type="text" value="{{ $getSettings->twitter }}" name="twitter"
                            placeholder="enter  twitter Name" class="form-control">
                        @error('twitter')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">

                        <input type="text" value="{{ $getSettings->instagram }}" name="instagram"
                            placeholder="enter  instagram Name" class="form-control">
                        @error('instagram')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input type="file" class="dropify"
                            data-default-file="{{ '/storage' . $getSettings->favicon }}" name="favicon" accept="image/*"
                            placeholder="enter user favicon" class="form-control">
                        @error('favicon')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="file" data-default-file="{{ '/storage' . $getSettings->logo }}"
                                class="dropify" data-default-file="url_of_your_file" name="logo" accept="image/*"
                                class="form-control">
                            @error('logo')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
            </div>
            <button class="form-group btn btn-primary" type="submit">update Setting</button>
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
