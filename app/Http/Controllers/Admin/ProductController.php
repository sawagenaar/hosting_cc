<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gesorteerde producten weergeven met pagination
        $products = Product::orderBy('id', 'desc')->paginate(4);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validatie van nieuw aangemaakte product
        $request->validate([
            'name' => 'required',
            'shortdescription' => 'nullable',
            'fulldescription' => 'nullable',
            'discount' => 'nullable',
            'price' => 'required',
            'weight' => 'required',
            'image' => 'nullable|image',
            'sub_category_slug' => 'required',
        ]);
        // Als de foto is ingevoegd, wordt de foto in de map(storage/app/public) geplaatst
        if($request->hasFile('image')) {
            $image = $request->file('image')->store('images.products');
        }
        // Een nieuwe product maken
        Product::create([
            'name' => $request->name,
            'shortdescription' => $request->shortdescription,
            'fulldescription' => $request->fulldescription,
            'discount' => $request->discount,
            'price' => $request->price,
            'weight' => $request->weight,
            'image' => $image ?? null,
            'sub_category_slug' => $request->sub_category_slug,
        ]);
        // Redirect naar de startpagina van de producten
        return redirect()->route('admin.products.index')->with('success', 'Product toegevoegd');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::find($slug);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // Validatie van update product
        $request->validate([
            'name' => 'required',
            'shortdescription' => 'nullable',
            'fulldescription' => 'nullable',
            'discount' => 'nullable',
            'price' => 'required',
            'weight' => 'required',
            'image' => 'nullable|image',
        ]);
        $product = Product::find($slug);
        // Controle van fotobestaan
        if(request()->hasFile('image') && request('image') != '') {
            $imagepath = ('storage/'.$product->image);
            // Als de oude foto bestaat en zich in de storage map bevindt, wordt deze foto verwijderd
            if(!is_null($product->image) && Storage::exists($product->image)) {
                unlink($imagepath);
            }
            // Als de foto is ingevoegd, wordt de foto in de map(storage/app/public) geplaatst
            $lastimage = $request->file('image')->store('images.products');
            $product->image = $lastimage;
        }
        // De oude slug verwijderen zodat deze automatisch wordt bijgewerkt
        // door het Sluggable pakket volgens de productnaam
        $product->slug = null;
        // Productvelden bijwerken
        $product->update([
            'name' => $request->name,
            'shortdescription' => $request->shortdescription,
            'fulldescription' => $request->fulldescription,
            'discount' => $request->discount,
            'price' => $request->price,
            'weight' => $request->weight,
            'image' => $product->image,
        ]);
        // Redirect naar de startpagina van de producten
        return redirect()->route('admin.products.index')->with('success', 'Product bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product = Product::find($slug);
        // Als de oude foto bestaat en zich in de storage map bevindt, wordt deze foto verwijderd
        if(!is_null($product->image) && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }
        // Een product verwijderen
        $product->delete();
        // Redirect naar de startpagina van de producten
        return redirect()->route('admin.products.index')->with('success', 'Product verwijderd');
    }
}
