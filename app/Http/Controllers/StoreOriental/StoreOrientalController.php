<?php

namespace App\Http\Controllers\StoreOriental;

use App\Models\StoreOriental;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreOrientalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeOrientals = StoreOriental::all();
        return view('orientals.oriental')->with('storeOrientals', $storeOrientals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $StoreOriental = new StoreOriental;
        $StoreOriental->fill($request->validate([
            'name_Oriental' => 'required',
            'note_Oriental' => 'required',
        ]));
        $StoreOriental->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreOriental  $StoreOriental
     * @return \Illuminate\Http\Response
     */
    public function show(StoreOriental $StoreOriental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreOriental  $StoreOriental
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreOriental $StoreOriental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreOriental  $StoreOriental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreOriental $StoreOriental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreOriental  $StoreOriental
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreOriental $StoreOriental)
    {
        $StoreOriental->delete();
        return redirect()->back();
    }
}
