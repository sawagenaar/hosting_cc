<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gesorteerde subcategorieën weergeven met pagination
        $subcategories = SubCategory::orderBy('id', 'desc')->paginate(4);
        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validatie van nieuw aangemaakte subcategorie
        $request->validate([
            'name' => 'required',
            'category_slug' => 'nullable',
        ]);
        // Een nieuwe subcategorie maken
        SubCategory::create($request->all());
        // Redirect naar de startpagina van de subcategorieën
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategorie toegevoegd');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $subcategory = SubCategory::find($slug);
        return view('admin.subcategories.edit', compact('subcategory'));
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
        // Validatie van update subcategorie
        $request->validate([
            'name' => 'required',
            'category_slug' => 'nullable',
        ]);
        $subcategory = SubCategory::find($slug);
        // Subcategorievelden bijwerken
        $subcategory->update([
            'name' => $request->name,
        ]);
        // Redirect naar de startpagina van de subcategorieën
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategorie bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $subcategory = SubCategory::find($slug);
        // Een subcategorie verwijderen
        $subcategory->delete();
        // Redirect naar de startpagina van de subcategorieën
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategorie verwijderd');
    }
}
