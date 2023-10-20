<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(): View
    {
        return view('main.account');
    }

    public function updateProfile(Request $request): RedirectResponse
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'required|string|min:6',
        ]);

        $fullName = $request->input('first_name') . ' ' . $request->input('last_name');

        $user = auth()->user();
        $user->update([
            'name' => $fullName,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('account')
            ->withSuccess('Профилът е актуализиран успешно.');
    }

    public function favorites(): View
    {
        return view('main.favorites');
    }
}
