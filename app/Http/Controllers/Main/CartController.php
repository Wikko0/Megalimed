<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{

    public function index(): View
    {

        return view('main.cart');
    }
}
