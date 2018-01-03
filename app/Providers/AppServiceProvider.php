<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Category;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 

        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
        return Hash::check($value, Auth::user()->password);
        });

        Schema::defaultStringLength(191);


        view()->composer('partials._nav', function($view){

            $categories=Category::where('is_active','=',1)->get();
            $view->with('categories',$categories);


        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
