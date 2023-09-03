<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use function view;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('main.home');
    }
}
