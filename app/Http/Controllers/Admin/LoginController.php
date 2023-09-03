<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('ap.login');
    }

    public function doLogin(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->input('remember'))) {
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->withErrors('Вие не сте администратор.');
            }
        } else {
            return redirect()->back()->withErrors('Грешен имейл или парола.');
        }
    }
}
