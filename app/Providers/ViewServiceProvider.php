<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Category;
use App\Models\RelatedSite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Avoid DB access during Artisan commands like config:clear, migrate
        if ($this->app->runningInConsole()) {
            return;
        }

        try {
            // Cache or retrieve latest posts
            if (!Cache::has('latestPost')) {
                $latestPost = Post::select('id', 'title', 'slug')->latest()->limit(5)->get();
                Cache::put('latestPost', $latestPost, now()->addYears(10));
            }

            // Cache or retrieve top commented posts
            if (!Cache::has('gratePostComments')) {
                $gratePostComments = Post::with('images')
                    ->select('id', 'title', 'slug')
                    ->withCount('comments')
                    ->orderBy('comments_count', 'desc')
                    ->take(5)
                    ->get();
                Cache::put('gratePostComments', $gratePostComments, now()->addYears(10));
            }

            // Now safely retrieve all data
            $latestPost = Cache::get('latestPost');
            $gratePostComments = Cache::get('gratePostComments');
            $relatedSite = RelatedSite::all();
            $categories = Category::with('posts')->select('id', 'name', 'slug')->get();

            View::share([
                'latestPost' => $latestPost,
                'gratePostComments' => $gratePostComments,
                'relatedSite' => $relatedSite,
                'categories' => $categories,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in ViewServiceProvider boot: ' . $e->getMessage());
            // You can choose to share empty/fallback values if needed
            View::share([
                'latestPost' => [],
                'gratePostComments' => [],
                'relatedSite' => [],
                'categories' => [],
            ]);
        }
    }
}
