<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // De laatste drie bestellingen weergeven in het adminpaneel

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $orders = Order::latest()->limit(3)->get();
        $orders->transform(function($order) {
            $order->cart_data = unserialize($order->cart_data);
            return $order;
        });
        return view('admin.index', compact('orders'));
    }
}
