@extends('layouts.dashboard.app')
@section('title')
    Add Role
@endsection
@section('body')
    <form action="{{ route('admin.authorization.store') }}" method="post" enctype="multipart/form-data">

        <div class="row">
            <div class="col-9">
                <h2 class="text-center">Add New Role</h2>

            </div>
            <div class="col-3">
                <a href="{{ route('admin.authorization.index') }}" class="btn btn-primary">Back to Roles</a>

            </div>
        </div> <br />

        @csrf
        <div class="card-body shadow">


            <div class="row">

                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="role" placeholder="enter role Name" class="form-control">
                        @error('role')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>
                </div>

            </div>
            <div class="row">
                @foreach (config('authorization.permissions') as $key => $value)
                    <div class="col-3">
                        <div class="form-group">
                            {{ $value }} : <input value="{{ $key }}" type="checkbox" name="permissions[]">
                        </div>


                    </div>
                @endforeach


            </div>

            <button class="form-group btn btn-primary" type="submit">Add New Role</button>

        </div>


        </div>
    </form>
@endsection
