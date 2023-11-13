<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            Mail::to($order->email)->send(new OrderMail());
        }

        return redirect()->back()->withSuccess('Усшено изпратихте този продукт!');
    }
}
