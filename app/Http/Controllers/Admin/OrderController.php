<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::paginate(8);
        $orders->appends(request()->query());

        return view('ap.order', compact('orders'));
    }

    public function doOrder($id)
    {
        $orders = Order::where('id', $id)->get();
        foreach ($orders as $order) {

            if ($order->status == 'Awaiting approval')
            {
                $order->update(['status' => 'Sent']);
            }

        }

        return redirect()->back()->withSuccess('Усшено изпратихте този продукт!');
    }
}
