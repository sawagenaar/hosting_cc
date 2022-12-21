<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id')->paginate(10);
        return view('superadmin.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userID = User::find($id);
        return view('superadmin.edit', compact('userID'));
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
        // Validatie van update subcategorie
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'user_type' => 'required'
        ]);
        $user = User::find($id);
        // Uservelden bijwerken
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type
        ]);
        // Redirect naar de startpagina van de subcategorieën
        return redirect()->route('superadmin.admin.index')->with('success', 'User bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = User::find($id);
        // Een user verwijderen
        $order->delete();
        // Redirect naar de pagina van de users
        return redirect()->route('superadmin.admin.index')->with('success', 'User verwijderd');
    }
}
