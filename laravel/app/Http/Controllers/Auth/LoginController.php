<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

         public function username()
     {
       return 'name';
     }

         // Override
    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        if ($user->permissions_id === 1) {
            // 管理ユーザ
            $this->redirectTo = '/orders';
        } elseif($user->permissions_id === 2){
            $this->redirectTo = '/orders';

        }elseif($user->permissions_id === 3){
            $this->redirectTo = '/ships';

        }elseif($user->permissions_id === 4){
            $this->redirectTo = '/orders';

        }
    }
}
