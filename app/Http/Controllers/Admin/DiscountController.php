<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::orderBy('id', 'desc')->paginate(4);
        return view('admin.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validatie van nieuw aangemaakte discount
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image',
            'startTime' => 'nullable',
            'endTime' => 'nullable',
            'shortdescription' => 'nullable',
            'fulldescription' => 'nullable',
        ]);
        // Als de foto is ingevoegd, wordt de foto in de map(storage/app/public) geplaatst
        if($request->hasFile('image')) {
            $image = $request->file('image')->store('images.discounts');
        }
        // Een nieuwe discount maken
        Discount::create([
            'title' => $request->title,
            'image' => $image ?? null,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'shortdescription' => $request->shortdescription,
            'fulldescription' => $request->fulldescription,
        ]);
        // Redirect naar de pagina van de discounts
        return redirect()->route('admin.discounts.index')->with('success', 'Discount toegevoegd');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = Discount::find($id);
        return view('admin.discounts.edit', compact('discount'));
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
        // Validatie van nieuw aangemaakte discount
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image',
            'startTime' => 'nullable',
            'endTime' => 'nullable',
            'shortdescription' => 'nullable',
            'fulldescription' => 'nullable',
        ]);
        $discount = Discount::find($id);
        // Controle van fotobestaan
        if(request()->hasFile('image') && request('image') != '') {
            $imagepath = ('storage/'.$discount->image);
            // Als de oude foto bestaat en zich in de storage map bevindt, wordt deze foto verwijderd
            if(!is_null($discount->image) && Storage::exists($discount->image)) {
                unlink($imagepath);
            }
             // Als de foto is ingevoegd, wordt de foto in de map(storage/app/public) geplaatst
            $lastimage = $request->file('image')->store('images.discounts');
            $discount->image = $lastimage;
        }
        // Discountsvelden bijwerken
        $discount->update([
            'title' => $request->title,
            'image' => $image ?? null,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'shortdescription' => $request->shortdescription,
            'fulldescription' => $request->fulldescription,
        ]);
        // Redirect naar de pagina van de discounts
        return redirect()->route('admin.discounts.index')->with('success', 'Discount bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);
        // Als de oude foto bestaat en zich in de storage map bevindt, wordt deze foto verwijderd
        if(!is_null($discount->image) && Storage::exists($discount->image)) {
            Storage::delete($discount->image);
        }
        // Een discount verwijderen
        $discount->delete();
        // Redirect naar de pagina van de discounts
        return redirect()->route('admin.discounts.index')->with('success', 'Discount verwijderd');
    }
}
