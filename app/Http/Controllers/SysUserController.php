<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SysUserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $valid = $request->validate([
            'username' => 'required|min:5',
            'password' => 'required|min:7',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended(route('products.index'));
        }

        return redirect()->back()->withErrors([
            'username' => 'Invalid username or password.',
        ])->withInput();
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'username' => 'required|min:5|unique:users,username',
            'password' => 'required|min:7|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return redirect(route('login'))->withSuccess('User has been registered successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}