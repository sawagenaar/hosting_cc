<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = NewsMessage::orderBy('id', 'desc')->paginate(4);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image',
            'shortdescription' => 'required',
            'fulldescription' => 'nullable',
        ]);
        if($request->hasFile('image')) {
            $image = $request->file('image')->store('images.news');
        }
        // Category::create($request->all());

        NewsMessage::create([
            'title' => $request->title,
            'image' => $image ?? null,
            'shortdescription' => $request->shortdescription,
            'fulldescription' => $request->fulldescription,
        ]);
        return redirect()->route('admin.news.index')->with('success', 'Nieuwsbericht toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsItem = NewsMessage::find($id);
        return view('admin.news.edit', compact('newsItem'));
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
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image',
            'shortdescription' => 'required',
            'fulldescription' => 'nullable',
        ]);
        $newsItem = NewsMessage::find($id);
        if(request()->hasFile('image') && request('image') != '') {
            $imagepath = ('storage/'.$newsItem->image);
            if(!is_null($newsItem->image) && Storage::exists($newsItem->image)) {
                unlink($imagepath);
            }
            $lastimage = $request->file('image')->store('images.news');
            $newsItem->image = $lastimage;
        }
        // $category->slug = null;
        $newsItem->update([
            'title' => $request->title,
            'image' => $newsItem->image,
            'shortdescription' => $request->shortdescription,
            'fulldescription' => $request->fulldescription,
        ]);
        return redirect()->route('admin.news.index')->with('success', 'Nieuwsbericht bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsItem = NewsMessage::find($id);
        if(!is_null($newsItem->image) && Storage::exists($newsItem->image)) {
            Storage::delete($newsItem->image);
        }
        $newsItem->delete();
        return redirect()->route('admin.news.index')->with('success', 'Nieuwsbericht verwijderd');
    }
}
