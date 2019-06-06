<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
    protected $redirectTo = '/admin';

    protected function authenticated(Request $request, User $user)
    {
        \Session::flash('flash_message_success', '<strong>' . Auth()->user()->name . '</strong>, seja bem vindo ao sistema!');
        \App\Util::getDefaultYear(null);

        if(Auth()->user()->access_level == 1)
        {
            $buildings = DB::table('users_buildings')->where('user_id', Auth()->user()->id)->pluck('predio_id')->toArray();
            if(count($buildings) > 0)
            {
                \Session::put('buildings', $buildings);
            }
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
