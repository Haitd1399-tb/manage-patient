<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreDrug;
use App\Models\storeOriental;
use App\Models\oriental;
use App\Models\Photo;
use Carbon\Carbon;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $patient = new Patient;
        $patient->fill($request->all());
        $patient->save();
        return redirect()->route('adminHome');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $storeDrugs = StoreDrug::select(['name_Drug', 'money_Drug', 'id'])->get();
        $storeOrientals = StoreOriental::select(['name_Oriental', 'id'])->get();
        $photos = Photo::where('patient_id', '=', $patient->id)->get();
        $orientals = Oriental::where('patient_id', '=', $patient->id)->get();
        $dateDay = Carbon::now('Asia/Ho_Chi_Minh');
        $drugs = $patient->drugs;
        $days = $patient->days;

        return view('admin.patient.detail')
                ->with('patient', $patient)                                 
                ->with('storeDrugs', $storeDrugs)
                ->with('storeOrientals', $storeOrientals)
                ->with('orientals', $orientals)
                ->with('dateDay', $dateDay)
                ->with('drugs', $drugs)
                ->with('days', $days)
                ->with('photos', $photos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('admin.patient.edit')->with('patient', $patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $patient->update([
            'name'=> $request->name,
            'age'=> $request->age,
            'validate'=> $request->validate,
            'phone_number'=> $request->phone_number,
            'anamnesis'=> $request->anamnesis,
            'note'=> $request->note,
            'village' => $request->village,
        ]);
        return redirect()->route('adminHome');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->back(); 
    }
    public function getPatient(Patient $patient) 
    {
        return view('treated.detail');
    }
}
