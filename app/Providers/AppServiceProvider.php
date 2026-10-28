<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use App\Services\Captcha;
use App\Tag;
use App\Category;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('captcha', function ($app) {
            return new Captcha(
                config('captcha.secret'),
                config('captcha.sitekey'),
                config('captcha.options', [])
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFour();

        Validator::extend('captcha', function ($attribute, $value) {
            return app('captcha')->verify($value, request()->getClientIp());
        });

        if (! \App::runningInConsole()) {
            $allCategories = Category::where('published', 1)->get();
            view()->share(compact('allCategories'));

            $allTags = Tag::where('published', 1)->orderBy('id', 'desc')->get();
            view()->share(compact('allTags'));
        }

        Carbon::setLocale('es');
    }
}
