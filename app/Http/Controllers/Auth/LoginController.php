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
        $loginValue = request('username');
        $this->username = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$this->username => $loginValue]);
        return property_exists($this, 'username') ? $this->username : 'email';
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     if (!auth()->attempt($credentials))
    //         abort(401, 'Credenciais Inválidas');

    //     $token = auth()->user()->createToken('auth_token');

    //     return response()->json([
    //         'data' => [
    //             'token' => $token->plainTextToken
    //         ]
    //     ]);
    // }
}
