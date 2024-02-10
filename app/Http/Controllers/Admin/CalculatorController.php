<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Calculator;
use App\Models\Order;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CalculatorController extends Controller
{
    public function index(): View
    {
        $XXS = Calculator::where('size', 'XXS')->first();
        $XS = Calculator::where('size', 'XS')->first();
        $S = Calculator::where('size', 'S')->first();
        $M = Calculator::where('size', 'M')->first();
        $L = Calculator::where('size', 'L')->first();
        $XL = Calculator::where('size', 'XL')->first();
        $XXL = Calculator::where('size', 'XXL')->first();
        $XXXL = Calculator::where('size', 'XXXL')->first();
        return view('ap.calculator', [
            'XXS' => $XXS,
            'XS' => $XS,
            'S' => $S,
            'M' => $M,
            'L' => $L,
            'XL' => $XL,
            'XXL' => $XXL,
            'XXXL' => $XXXL,
        ]);
    }

    public function doCalculator(Request $request)
    {
        $this->validate($request, [
            'size' => ['required'],
            'minHeight' => ['required'],
            'maxHeight' => ['required'],
            'minKg' => ['required'],
            'maxKg' => ['required'],

            'lengthTop' => ['required'],
            'widthTop' => ['required'],
            'lengthBot' => ['required'],
            'widthBot' => ['required'],
        ]);

        Calculator::where('size', $request->input('size'))->update([
           'minHeight' => $request->input('minHeight'),
           'maxHeight' => $request->input('maxHeight'),
           'minKg' => $request->input('minKg'),
           'maxKg' => $request->input('maxKg'),

            'lengthTop' => $request->input('lengthTop'),
            'widthTop' => $request->input('widthTop'),
            'lengthBot' => $request->input('lengthBot'),
            'widthBot' => $request->input('widthBot'),
        ]);

        return redirect()->back()->withSuccess('Усшено обновихте калкулатора за размер '.$request->input('size'));
    }
}
