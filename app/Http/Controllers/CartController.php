<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // Op token gebaseerde unieke gebruikers-ID
        $userID = CartFacade::session('_token');
        // Totaal aantal artikelen in de winkelwagen
        $cartTotalQuantity = $userID->getTotalQuantity();
        // Totale kosten van producten
        $subTotal = $userID->getSubTotal();
        // Producten in de winkelwagen
        $items = $userID->getContent();
        // Sorteren
        $sort = $request->sort;
        return view('cart.index', compact('items', 'cartTotalQuantity', 'subTotal', 'sort'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\$product
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Op token gebaseerde unieke gebruikers-ID
        $userID = CartFacade::session('_token');
        $product = Product::find($request->slug);
        // Kortingsprijs
        $discounted_price = $product->discounted_price;
        // Een nieuw product in de winkelwagen plaatsen
        $userID->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => round($discounted_price, 2),
            'quantity' => $request->qty,
            'attributes' => [
                'added_at' => Carbon::now(),
            ],
            'associatedModel' => $product
        ));
        // Een bericht weergeven over een succesvolle bewerking
        Session::flash('success', 'Product toegevoegd aan winkelwagen');
        return redirect('pages.category');
    }

    // Het aantal items in de winkelwagen verminderen
    public function minus(Request $request, $id) {
        // Op token gebaseerde unieke gebruikers-ID
        $userID = CartFacade::session('_token');
        $item = $userID->get($request->id);;
            if ($userID->isEmpty()) {
                abort(404);
            }
            if ($item->quantity == 1) {
                $userID->remove($request->id);
            } else {
                CartFacade::update ($request->id, array(
                    'quantity' => - 1,
                    ));
                }
        return redirect()->route('cart.index');
    }
    // Items in de winkelwagen vergroten
    public function plus(Request $request, $id) {
        $userID = CartFacade::session('_token');
        if ($userID->isEmpty()) {
            abort(404);
        }
        CartFacade::update ($request->id, array(
            'quantity' => 1,
        ));
        return redirect()->route('cart.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Een artikel uit de winkelwagen verwijderen
    public function remove(Request $request, $id)
    {
        $userID = CartFacade::session('_token');
        $userID->remove($request->id);
        return back()->with('success', 'Product verwijderd');
    }
}