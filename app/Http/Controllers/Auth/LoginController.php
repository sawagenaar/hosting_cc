<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    // Als de gebruiker een admin is, wordt hij omgeleid naar de adminpaneel, als de gebruiker - naar de site
    protected function authenticated($request, $user) {
        $route = 'user.index';
        if ($user->user_type == 'admin') {
            $route = 'admin.index';
            return redirect()->route($route);
        } elseif ($user->user_type == 'superadmin') {
            $route = 'superadmin.admin.index';
            return redirect()->route($route);
        } elseif ($user->user_type == 'user') {
            $route = 'user.index';
            return Redirect::to(Session::get('url.intended'))->with('success', ' Welcom,  ' . auth()->user()->name .'!');
        } else {
        // return redirect()->route($route);
            auth()->guard('web')->logout();
            return response()->redirectTo('/login');
        }
    }
}
