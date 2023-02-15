<?php

namespace App\Http\Controllers\Treated;

use App\Http\Controllers\Controller;
use App\Models\Oriental;
use App\Models\Patient;
use App\Models\StoreDrug;
use App\Models\storeOriental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TreatedController extends Controller
{
    public function treated(Patient $patient)
    {
        $patient->treated = true;
        $patient->save();
        return redirect()->back();
    }

    public function homeTreated() {
        $patients = Patient::where('treated', true)->get();
        return view('treated.treated')->with('patients', $patients);
    }
    public function Untreated(Patient $patient) {
        $patient->debit = true;
        $patient->treated = false;
        $patient->save();
        return redirect()->back();

    } 
    public function Showtreated(Patient $patient) {
        $storeDrugs = StoreDrug::select(['name_Drug', 'money_Drug', 'id'])->get();
        $storeOrientals = storeOriental::select(['name_Oriental', 'id'])->get();
        $orientals = Oriental::all();
        $dateDay = Carbon::now('Asia/Ho_Chi_Minh');
        $drugs = $patient->drugs;
        $days = $patient->days;

        return view('treated.detail')
                ->with('patient', $patient)                                 
                ->with('storeDrugs', $storeDrugs)
                ->with('storeOrientals', $storeOrientals)
                ->with('orientals', $orientals)
                ->with('dateDay', $dateDay)
                ->with('drugs', $drugs)
                ->with('days', $days);
    }
}
