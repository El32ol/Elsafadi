<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class SetAppLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if($user)
        {
            $locale = $user->language;
        }
        else
        {
            //for catch the lang of the pc 
            $accept_language = $request->header('accept-language');
            $lang_array = explode(',' , $accept_language);// bcz the pc has a lot of land in array
            $locale = $lang_array[0] != 'en';
            // $locale = ($lang_array[0] != 'ar') ? 'ar' : 'en';

            

            $locale = request('lang' , Session::get('lang' , $locale));
            Session::put('lang' , $locale); //for put the lang From url in lang from $locale
        
            $locale = $request->route('locale' , $locale); // for catch parameter from URL
        }
         $locales = ['ar' , 'en'];

         if(!in_array($locale , $locales))
         {
            abort(404);
         }
        App::setLocale($locale);

        // for definition variable form rout in all route
        URL::defaults([
            'locale' =>$locale
        ]);

        // for ignore the param in the all methods in controller we use
        // here for not send the  param in controller 
        Route::current()->forgetParameter('locale' , App::getLocale());

        return $next($request);
    }
}
