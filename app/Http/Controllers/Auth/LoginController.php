<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    use AuthenticatesUsers {
        logout as performLogout;
    }

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
        $this->middleware('guest:orang_tua')->except('logout');
    }

    // login with
    public function username()
    {
        $login = request()->input('identity_number');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'identity_number';
        request()->merge([$field => $login]);
        return $field;
    }

    public function login(Request $request)
    {
        if (Auth::guard('orang_tua')->attempt(['nim_mahasiswa' => $request->identity_number, 'password' =>
        $request->password], $request->remember)) {
            return redirect()->intended($this->redirectTo);
        } else if (Auth::guard('web')->attempt(['identity_number' => $request->identity_number, 'password' =>
        $request->password], $request->remember)) {
            return redirect()->intended($this->redirectTo);
        } else {
            return back()->withInput($request->only('identity_number'))->withErrors(['password' => "Tidak bisa login tolong masukan username dan password yang benar"]);
        }        
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')) {
            Auth::guard('web')->logout();
        }

        if (Auth::guard('orang_tua')){
            Auth::guard('orang_tua')->logout();
        }


        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function perform()
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }


}
