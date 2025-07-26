<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $error = null;
    
    public function register()
    {
        return view('auth.register');    
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if (!$user) {
            echo 'Register failed.';
        }

        Auth::attempt($request->only(['email', 'password']));
        $request->session()->regenerate();
        
        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');

    }

    public function login_form()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $login = $this->_loginHandler($request);
        
        if($login) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            if($this->error === 'Email not registered!') {
                return back()->withErrors(['email' => 'Email not registered!'])->onlyInput('email');
            } else {
                return back()->withErrors(['email' => 'Email or password incorrected!'])->onlyInput('email');
            }
        }

    }

    private function _loginHandler(Request $request): bool
    {
        $auth = Auth::attempt($request->only(['email', 'password']));        
        if (!$auth) {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                $this->error = 'Email not registered!';
                return false;
            } else {
                $this->error = 'Email or password incorrected!';
                return false;
            }
        }

        return true;
    }
}
