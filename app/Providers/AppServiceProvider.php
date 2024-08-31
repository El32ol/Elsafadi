<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //api resource wraping
        JsonResource::withoutWrapping();

        // for set lang or get it from Url

        // $lang = request('lang' , 'en'); // it catch the variable lang from url
          
        // $locale = request('lang' , Session::get('lang' , 'en'));
        // Session::put('lang' , $locale); //for put the lang From url in lang from $locale
        // App::setLocale( $locale);
        //=> doesn't work here in session so we will make middleware


        // filter custom function 
        Validator::extend('filter' , function($attribute , $value)
        {
            if($value == 'god')
            {
                return false;
            }
            else
            {
                return true;
            }
        } , 'This Word No .');
        
        Paginator::useBootstrap();
    }
}
