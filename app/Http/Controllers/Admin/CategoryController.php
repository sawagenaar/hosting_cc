<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // Gesorteerde categorieën weergeven met pagination
        $categories = Category::orderBy('id', 'desc')->paginate(4);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validatie van nieuw aangemaakte categorie
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
        ]);
        // Als de foto is ingevoegd, wordt de foto in de map(storage/app/public) geplaatst
        if($request->hasFile('image')) {
            $image = $request->file('image')->store('images.categories');
        }
        // Een nieuwe categorie maken
        Category::create([
            'name' => $request->name,
            'image' => $image ?? null,
        ]);
        // Redirect naar de startpagina van de categorieën
        return redirect()->route('admin.categories.index')->with('success', 'Categorie toegevoegd');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category::find($slug);
        return view('admin.categories.edit', compact('category'));
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
        // Validatie van update categorie
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
        ]);
        $category = Category::find($slug);
        // Controle van fotobestaan
        if(request()->hasFile('image') && request('image') != '') {
            $imagepath = ('storage/'.$category->image);
            // Als de oude foto bestaat en zich in de storage map bevindt, wordt deze foto verwijderd
            // dd($imagepath);
            if(!is_null($category->image) && Storage::exists($category->image)) {
                unlink($imagepath);
            }
            // Als de foto is ingevoegd, wordt de foto in de map(storage/app/public) geplaatst
            $lastimage = $request->file('image')->store('images.categories');
            $category->image = $lastimage;
        }
        // Сategorievelden bijwerken
        $category->update([
            'name' => $request->name,
            'image' => $category->image,
        ]);
        // Redirect naar de startpagina van de categorieën
        return redirect()->route('admin.categories.index')->with('success', 'Categorie bewerkt');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category = Category::find($slug);
        // Als de oude foto bestaat en zich in de storage map bevindt, wordt deze foto verwijderd
        if(!is_null($category->image) && Storage::exists($category->image)) {
            Storage::delete($category->image);
        }
        // Een categorie verwijderen
        $category->delete();
        // Redirect naar de startpagina van de categorieën
        return redirect()->route('admin.categories.index')->with('success', 'Categorie verwijderd');
    }
}
