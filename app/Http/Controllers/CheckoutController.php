<?php

namespace App\Http\Controllers;

use App\Models\Deliveryaddress;
use App\Models\Order;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function profile() {
        $user = Auth::user();
        // Op token gebaseerde unieke gebruikers-ID
        $userID = CartFacade::session('_token');
        // Totaal aantal artikelen in de winkelwagen
        $cartTotalQuantity = $userID->getTotalQuantity();
        // Totale kosten van producten
        $subTotal = $userID->getSubTotal();
        // Producten in de winkelwagen
        $items = $userID->getContent();
        return view('cart.profile', compact('items', 'cartTotalQuantity', 'subTotal', 'user'));
    }

    public function delivery(Request $request) {
        $user = Auth::user();
        // Op token gebaseerde unieke gebruikers-ID
        $userID = CartFacade::session('_token');
        // Producten in de winkelwagen
        $items = $userID->getContent();
        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ]);
        if  (Deliveryaddress::where('user_id', $user->id)->exists()) {
            $delivery = Deliveryaddress::where('user_id', $user->id)->first();
            $delivery->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        } else {
        // Nieuwe delivery address aan de tabel toevoegen
            $delivery = new Deliveryaddress();
            $delivery->user_id = $user->id;
            $delivery->name = $request->name;
            $delivery->surname = $request->surname;
            $delivery->phone = $request->phone;
            $delivery->address = $request->address;
            $delivery->save();
        }
        return view('cart.delivery', compact('items', 'delivery', 'user'));
    }

    public function make(Request $request, $id) {
        // Op token gebaseerde unieke gebruikers-ID
        $userID = CartFacade::session('_token');
        // Producten in de winkelwagen
        $items = $userID->getContent();
        $userid = Auth::user()->id;
        // Totaal aantal artikelen in de winkelwagen
        $cartTotalQuantity = $userID->getTotalQuantity();
        // Totale kosten van producten
        $subTotal = $userID->getSubTotal();
        // Nieuwe velden voor bestellingen aan de tabel toevoegen
        $this->validate($request, [
            'day' => 'required|max:255',
            'partday' => 'required|max:255',
        ]);
        $delivery = Deliveryaddress::where('user_id',$userid)->first();
        $order = new Order();
        $order->user_id = $userid;
        $order->email = Auth::user()->email;
        $order->name = $delivery->name;
        $order->surname = $delivery->surname;
        $order->address = $delivery->address;
        $order->phone = $delivery->phone;
        $order->day = $request->day;
        $order->partday = $request->partday;
        $order->cart_data = $order->setCartDataAttribute($items);
        $order->totalQuantity = $cartTotalQuantity;
        $order->subTotal = $subTotal;
        $order->save();
        // Winkelwagengegevens verwijderen als de bestelling is opgeslagen
        if ($order->save()) {
            $userID->clear();
            return redirect()->route('cart.index')->with('success', 'Orded created successfully');
        }
        return view('cart.index', compact('items', 'subTotal', 'cartTotalQuantity'));
    }

    public function orders() {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        // deserialiseren van gegevens cart_data
        $orders->transform(function($order) {
            $order->cart_data = unserialize($order->cart_data);
            return $order;
        });
        return view('cart.orders', compact('orders'));
    }

    public function order($id) {
        $user = Auth::user();
        // Geselecteerde order
        $order = Order::where('id', $id)->firstOrFail();
        // deserialiseren van gegevens cart_data
        $order->cart_data = unserialize($order->cart_data);
        return view('cart.order', compact('order'));
    }
}