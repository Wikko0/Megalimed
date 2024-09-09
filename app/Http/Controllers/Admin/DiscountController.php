<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class DiscountController extends Controller
{
    public function index(): View
    {
        $discount = Discount::first();
        return view('ap.discount', compact('discount'));
    }

    public function doDiscount(Request $request): RedirectResponse
    {


        $this->validate($request, [
            'name' => ['required'],
            'percent' => ['required'],
            'date' => ['required'],
        ]);

        if ($request->image){
            $file = $request->file("image");
            $photoPath = $file->storeAs('/img', 'discount.jpg',['disk' => 'public_uploads']);

            $photo = Image::make(public_path("{$photoPath}"));
            $photo->save();

        }

        Discount::updateOrCreate([
            'id' => '1'
        ],
            [
                'status' => $request->status,
                'name' => $request->name,
                'percent' => $request->percent,
                'date' => $request->date,
            ]);

        return redirect()->route('admin.discount')->withSuccess('Усшено пуснахте намаление!');
    }
}
