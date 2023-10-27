<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index($id): View
    {
        $product = Product::findOrFail($id);

        return view('main.product', compact('product'));
    }
}
