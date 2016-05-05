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
        if(!Session::has('locale'))
        {
            Session::put('locale', $request->getPreferredLanguage($this->languages));
        }
        $lang = Request::input('lang');
        if (in_array($lang, $this->languages))
        {
            Session::put('locale', $lang);
        }

        app()->setLocale(Session::get('locale'));

//        if(!Session::has('statut'))
//        {
//            Session::put('statut', Auth::check() ?  Auth::user()->role->slug : 'visitor');
//        }
        return $next($request);
    }
}
