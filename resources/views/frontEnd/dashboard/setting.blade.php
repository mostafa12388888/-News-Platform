@extends('layouts.frontend.app')
@section('title')
    {{ config('app.name') }} | seating
@endsection
@section('body')
    <!-- Dashboard Start-->
    <br />
    <br />
    <br />
    <br />
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontEnd.dashboard._sidebar',['settingActive'=>'active'])


        <!-- Main Content -->
        <div class="main-content">
            <!-- Settings Section -->
            <section id="settings" class="content-section active">
                <h2>Settings</h2>
                <form action="{{ route('frontend.dashboard.setting.update') }}" method="post" class="settings-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="{{ $user->user_name }}" />
                        @error('username')
                            <small>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">name:</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" />
                        @error('name')
                            <small>
                                {{ $message }}
                            </small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}" />
                        @error('email')
                            <small>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="profile-image">Profile Image:</label>
                        <input type="file" name="image" id="profile-image" accept="image/*" />
                        @error('image')
                            <small>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" placeholder="Enter your country"
                            value="{{ $user->country }}" />
                        @error('country')
                            <small>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city"name="city" placeholder="Enter your city"
                            value="{{ $user->city }}" />
                        @error('city')
                            <small>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input type="text" id="street" name="street" placeholder="Enter your street"
                            value="{{ $user->street }}" />
                        @error('street')
                            <small>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" placeholder="Enter your phone"
                            value="{{ $user->phone }}" />
                        @error('phone')
                            <small>
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <button type="submit" class="save-settings-btn">
                        Save Changes
                    </button>
                </form>

                <!-- Form to change the password -->
                <form action="{{ route('frontend.dashboard.setting.change-Password') }}" method="post"
                    class="change-password-form">
                    @csrf
                    <h2>Change Password</h2>
                    <div class="form-group">
                        <label for="current-password">Current Password:</label>
                        <input type="password" name="current_password" id="current-password"
                            placeholder="Enter Current Password" />
                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <input type="password" name="password" id="password" placeholder="Enter New Password" />
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password:</label>
                        <input type="password" name="password_confirmation" id="confirm-password"
                            placeholder="Enter Confirm New " />
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="change-password-btn">
                        Change Password
                    </button>
                </form>
            </section>
        </div>
    </div>
    <br />
    <br />
    <br />
    <br />

    <!-- Dashboard End-->
@endsection
