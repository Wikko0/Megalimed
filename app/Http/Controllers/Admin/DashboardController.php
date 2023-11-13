<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $orders = Order::get();
        $count = $orders->count();
        $totalPrice = 0;

        $sevenWeeksAgo = Carbon::now()->subWeeks(7);

        $newUsersCount = User::where('created_at', '>=', $sevenWeeksAgo)->count();
        $totalUsersCount = User::count();

        foreach ($orders as $order) {

            foreach (json_decode($order->products, true) as $value){
                $totalPrice += $value['price'];
            }
        }


        return view('ap.dashboard', [
            'count' => $count,
            'totalPrice' => $totalPrice,
            'totalUsersCount' => $totalUsersCount,
            'newUsersCount' => $newUsersCount,]);
    }
}
