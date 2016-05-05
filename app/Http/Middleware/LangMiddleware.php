<?php

namespace App\Http\Middleware;

use Closure, Session, Auth, Request;

class LangMiddleware
{
    protected $languages = ['en','ru'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Session::put('locale', 'en');
        $lang = Request::input('lang');
        if (in_array($lang, $this->languages))
        {
            Session::put('locale', $lang);
            Session::put('locale_changed', $lang);
        }
        elseif(Session::has('locale_changed'))
        {
            Session::put('locale', Session::get('locale_changed'));
        }
        app()->setLocale(Session::get('locale'));

//        if(!Session::has('statut'))
//        {
//            Session::put('statut', Auth::check() ?  Auth::user()->role->slug : 'visitor');
//        }
        return $next($request);
    }
}
