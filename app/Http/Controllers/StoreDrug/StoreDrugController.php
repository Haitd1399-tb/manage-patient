<?php

namespace App\Http\Controllers\StoreDrug;

use App\Models\StoreDrug;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreDrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeDrugs = StoreDrug::all();
        return view('drugs.detail_drug')->with('storeDrugs', $storeDrugs);
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
        $storeDrug = new StoreDrug;
        $storeDrug->fill($request->validate([
            'name_Drug' => 'required',
            'money_Drug' => 'required',
            'quanlity_Drug' => 'required',
        ]));
        $storeDrug->note_Drug = $request->note_Drug;
        $storeDrug->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreDrug  $storeDrug
     * @return \Illuminate\Http\Response
     */
    public function show(StoreDrug $storeDrug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreDrug  $storeDrug
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreDrug $storeDrug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreDrug  $storeDrug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreDrug $storeDrug)
    {
        $storeDrug->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreDrug  $storeDrug
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreDrug $storeDrug)
    {
        $storeDrug->delete();
        return redirect()->back();
    }
}
