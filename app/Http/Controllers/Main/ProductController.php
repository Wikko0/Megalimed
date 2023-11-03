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

    public function calculator($productId, Request $request)
    {
        $calculator = $request->input('calculator');
        $product = Product::findOrFail($productId);
        $productSize = json_decode($product->size);

        foreach ($productSize as $sizes) {
            $size = strtolower($sizes);
            if ($product->getAttribute($size)) {
                $attributeSize = explode("-", $product->getAttribute($size));
                $minHeight = (int) $attributeSize[0];
                $maxHeight = (int) $attributeSize[1];

                if ($calculator >= $minHeight && $calculator <= $maxHeight) {
                    return redirect()->back()->with('calculator_message', strtoupper($size));
                }
            }
        }

        return redirect()->back()->with('calculator_message', 'Няма размер който да отговаря на вашият ръст');
    }


}
