<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Hamcrest\Core\Set;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $settings = Settings::first();
        return view('ap.settings', compact('settings'));
    }

    public function doSettings(Request $request): RedirectResponse
    {

        $this->validate($request, [
            'email' => ['required', 'email'],
            'address' => ['required'],
            'phone' => ['required'],
            'facebook' => ['required'],
            'instagram' => ['required'],
        ]);

        Settings::updateOrCreate([
            'id' => '1'
        ],
            [
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
            ]);

        return redirect()->route('admin.settings')->withSuccess('Обновихте настройките успешно!');
    }

}
