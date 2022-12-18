<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // Gesorteerde categorieën weergeven met pagination
        $orders = Order::orderBy('id', 'desc')->paginate(6);
        $orders->transform(function($order) {
            $order->cart_data = unserialize($order->cart_data);
            return $order;
        });
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $order = Order::where('id', $id)->firstOrFail();
        $order->cart_data = unserialize($order->cart_data);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validatie van update order
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'name' => 'nullable',
            'surname' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'status' => 'required',
        ]);
        $order = Order::find($id);
        // Ordervelden bijwerken
        $order->update([
            'email' => $request->email,
            'name' => $request->name,
            'surname' => $request->surname,
            'address' => $request->address,
            'phone' => $request->phone,
            'day' => $request->day,
            'partday' => $request->partday,
            'subTotal' => $request->subTotal,
            'shipping_cost' => $request->shipping_cost,
            'status' => $request->status,
        ]);
        // Redirect naar de pagina van de orders
        return redirect()->route('admin.orders.index')->with('success', 'Order bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        // Een order verwijderen
        $order->delete();
        // Redirect naar de pagina van de orders
        return redirect()->route('admin.orders.index')->with('success', 'Order verwijderd');
    }
}
