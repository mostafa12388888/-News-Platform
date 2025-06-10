<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if(!Cache::has('readMorePosts')){
            $readMorePosts=Post::select('id','title','slug')->latest()->limit(10)->get();
            Cache::remember('readMorePosts',3600,function()use($readMorePosts){return $readMorePosts;});
        }
        $readMorePosts=Cache::get('readMorePosts');
        view()->share([
           'readMorePosts'=>$readMorePosts
        ]);

    }
}
