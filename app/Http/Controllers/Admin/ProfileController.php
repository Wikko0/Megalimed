<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('ap.profile');
    }

    public function doChangeEmail(Request $request): RedirectResponse
    {

        $this->validate($request, [
            'new_email' => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::user()->id),],
        ]);

        Auth::user()->update(['email' => $request->input('new_email')]);

        return redirect()->route('admin.profile')->withSuccess('Сменихте емайла успешно!');
    }

    public function doChangePassword(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'new_password' => 'required|min:8',
        ]);

        $newPassword = bcrypt($request->input('new_password'));

        Auth::user()->update(['password' => $newPassword]);

        return redirect()->route('admin.profile')->withSuccess('Сменихте паролата успешно!');
    }
}
