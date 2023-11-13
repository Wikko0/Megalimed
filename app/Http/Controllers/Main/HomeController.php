<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;
use function view;

class HomeController extends Controller
{
    public function index(): View
    {
        $recommendedProducts = Product::recommendedProducts(auth()->id());

        return view('main.home', ['recommendedProducts' => $recommendedProducts]);
    }
}
