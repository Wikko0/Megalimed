<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Calculator;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index($slug): View
    {
        $product = Product::where('status', 'Published')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('main.product', compact('product'));
    }

    public function calculator(Request $request)
    {

        $height = $request->input('height');
        $kilograms = $request->input('kilograms');
        $calculator = Calculator::get();

        foreach ($calculator as $value) {
            $minHeight = $value->minHeight;
            $maxHeight = $value->maxHeight;
            $minKg = $value->minKg;
            $maxKg = $value->maxKg;
            $size = $value->size;

            if ($kilograms >= $minKg && $kilograms <= $maxKg && $height >= $minHeight && $height <= $maxHeight) {
                return redirect()->back()->with('calculator_message', strtoupper($size));
            }


        }

        return redirect()->back()->with('calculator_message', 'Няма размер който да отговаря на вашият ръст');
    }


}
