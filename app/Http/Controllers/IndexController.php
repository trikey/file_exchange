<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;

use App\Http\Requests;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\LangMiddleware');
        $this->middleware('auth');
    }


    public function index()
    {
        if (Auth::user()->canAccess || Auth::user()->isAdmin || Auth::user()->isModerator)
        {
            return redirect(route('admin_folders'));
        }
        return view('index');
//        return redirect(route('admin_folders'));
    }
}
