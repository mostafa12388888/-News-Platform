<?php

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\dashboard\NotificationController;
use App\Http\Controllers\Frontend\dashboard\ProfileController;
use App\Http\Controllers\Frontend\dashboard\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewSubscriberController;
use App\Http\Controllers\frontend\PostController;
use App\Http\Controllers\Frontend\SearchController;
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

// Route::get('/', function () {
//     return ;
// });

Route::redirect('/', '/home');
Route::group(['as' => 'frontend.'], function () {
    Route::fallback(function () {
        return view('errors.404');
    });
    Route::get('wite', function () {
        return view('frontEnd.wait');
    })->name('wait');
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('index');
        // ->middleware(['auth','verified']);
    });
    Route::get('category/{slug}', CategoryController::class)->name('category.posts');
    Route::prefix('post')->controller(PostController::class)->group(function () {
        Route::get('/{slug}', 'show')->name('post.show');
        Route::get('/comment/{slug}', 'getAllComments')->name('comment.show');
        Route::post('/comment', 'store')->name('comment.store');
    });
    Route::prefix('contact')->controller(ContactController::class)->name('contact.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });
    Route::match(['get', 'post'], '/search', SearchController::class)->name('search');
    Route::prefix('account')->name('dashboard.')->middleware(['auth:web', 'verified', 'checkUserStatus'])->group(function () {
        // manage Profile page
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'index')->name('profile');
            Route::post('post/store', 'storePost')->name('post.store');
            Route::get('post/edit/{slug}', 'editPost')->name('post.edit');
            Route::put('post/update/{id}', 'updatePost')->name('post.edit');
            Route::post('post/image/delete/{image_id}', 'deleteImagePost')->name('post.image.delete'); //post.image.delete
            Route::delete('post/delete', 'deletePost')->name('post.delete');
            Route::get('post/get-comments/{id}', 'getComments')->name('post.comments');
        });
        //setting Routes
        Route::controller(SettingController::class)->group(function () {
            Route::get('setting', 'getSetting')->name('setting');
            Route::post('setting/update', 'update')->name('setting.update');
            Route::post('setting/change-password', 'changePassword')->name('setting.change-Password');
        });
        // Notification Routes
        Route::controller(NotificationController::class)->group(function () {
            Route::get('notification', 'getNotification')->name('notification');
            Route::get('notification/read-all', 'readAll')->name('notification.read-all');
            Route::post('notification/update', 'update')->name('notification.update');
            Route::post('notification/change-password', 'changePassword')->name('notification.change-Password');
            Route::delete('notification/delete', 'deleteNotification')->name('notification.delete');
            Route::get('notification/delete/all', 'deleteNotificationAll')->name('notification.delete.all');
        });
    });
});


Route::controller(NewSubscriberController::class)->group(function () {
    Route::post('news-subscribe', 'store')->name('news.subscribe');
});
Route::prefix('email')->controller(VerificationController::class)->name('verification.')->group(function () {
    Route::get('/verify', 'show')->name('notice');
    Route::get('/verify/{id}/{hash}', 'verify')->name('verify');
    Route::post('/resend', 'resend')->name('resend');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
