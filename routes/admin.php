<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Admin\Authorization\AuthorizationController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\GeneralSearchController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Notification\NotificationController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::fallback(function () {
    return view('errors.404');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login.show');
    Route::post('/login', 'checkAuth')->name('login.check');
    Route::post('/logout', 'logout')->name('logout');
});
Route::prefix('password')->name('password.')->group(function () {
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::post('/forget', 'forgetPassword')->name('forget');
    });
    Route::controller(ForgetPasswordController::class)->group(function () {
        Route::get('/email', 'showEmailForm')->name('email');
        Route::post('/email', 'sendOtp')->name('email');
        Route::get('/verify/{email}', 'showOtpForm')->name('showOtpForm');
        Route::post('/verify', 'verifyOtp')->name('verifyOtp');
    });
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('/reset/email', 'reset')->name('reset');
        Route::post('/reset', 'createPassword')->name('reset');
    });
});

Route::group(['middleware' => ['auth:admin','checkAdminStatus']], function () {
    Route::redirect('/', '/home');
    Route::resource('authorization', AuthorizationController::class)->middleware('can:authorization');
    Route::resource('users', UserController::class)->middleware('can:users');
    Route::resource('admins', AdminController::class)->middleware('can:admins');
    Route::resource('posts', PostController::class)->middleware('can:posts');
    Route::resource('categories', CategoryController::class)->middleware('can:categories');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // General Search Route
    Route::get('/search', [GeneralSearchController::class, 'search'])->name('search');

    Route::get('user/status/{id}', [UserController::class, 'statusChange'])->name('user.status');
    Route::get('admin/status/{id}', [AdminController::class, 'statusChange'])->name('admin.status');
    Route::get('post/status/{id}', [PostController::class, 'statusChange'])->name('post.status');
    Route::get('comment/delete/{id}', [PostController::class, 'deleteComment'])->name('comment.delete');
    Route::get('category/status/{id}', [CategoryController::class, 'statusChange'])->name('category.status');
    // ================>>>>>>>>>>>>>>>>>>>>>Setting Route<<<<<<<<<<<<<<<<<<++++++++++++++++++++++
    Route::controller(SettingController::class)->prefix('settings')->name('settings.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('can:settings');
        Route::post('/', 'update')->name('update')->middleware('can:settings');
    });
    // ================>>>>>>>>>>>>>>>>>>>>>end Setting Route<<<<<<<<<<<<<<<<<<++++++++++++++++++++++
    // ================>>>>>>>>>>>>>>>>>>>>>Profile Admin Route<<<<<<<<<<<<<<<<<<++++++++++++++++++++++
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'update')->name('update');
    });
    // ================>>>>>>>>>>>>>>>>>>>>>end Profile Admin Route<<<<<<<<<<<<<<<<<<++++++++++++++++++++++
    // ================>>>>>>>>>>>>>>>>>>>>>Contacts Route<<<<<<<<<<<<<<<<<<++++++++++++++++++++++
    Route::controller(ContactController::class)->prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
        Route::get('status/{id}', 'statusChange')->name('status');
    });
    // ================>>>>>>>>>>>>>>>>>>>>>contact Route<<<<<<<<<<<<<<<<<<++++++++++++++++++++++
    // ================>>>>>>>>>>>>>>>>>>>>>Notification Route<<<<<<<<<<<<<<<<<<++++++++++++++++++++++
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
    Route::get('/notification/delete/{id}', [NotificationController::class, 'deleteNotification'])->name('notification.delete');
    Route::get('/notification/delete-all', [NotificationController::class, 'deleteAll'])->name('notification.delete-all');
});
