<?php

namespace App\Http\Controllers\Oriental;

use App\Models\Oriental;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Carbon\Carbon;

class OrientalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $oriental_ids = $request->storeoriental_id;
        $oriental_weights = $request->weight_Oriental;
        $patient_id = $request->patient_id;
        $date = Carbon::now();
        for($i = 0; $i< count($oriental_ids); $i++) {
            $oriental = new Oriental;
            $oriental->patient_id = $patient_id;
            $oriental->storeoriental_id = $oriental_ids[$i];
            $oriental->weight_Oriental = $oriental_weights[$i];
            $oriental->validate_Oriental = $date;

            $oriental->save();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Oriental  $oriental
     * @return \Illuminate\Http\Response
     */
    public function show(Oriental $oriental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Oriental  $oriental
     * @return \Illuminate\Http\Response
     */
    public function edit(Oriental $oriental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Oriental  $oriental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Oriental $oriental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Oriental  $oriental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oriental $oriental, Request $request)
    {
        $oriental->delete();
        return redirect()->back();
    }

    public function pay(Patient $patient, Request $request) {
        $datePay = Carbon::now('Asia/Ho_Chi_Minh');
        $orientals = Oriental::where('patient_id', '=', $patient->id)->get();
        return view('orientals.pay')->with('datePay', $datePay)
                                    ->with('patient', $patient)
                                    ->with('orientals', $orientals);
    }
}
