<?php

namespace App\Http\Controllers\Debit;

use App\Http\Controllers\Controller;
use App\Models\Patient;

class DebitController extends Controller
{
    public function homeDebit() {
        $patients = Patient::where('debit', true)->get();
        return view('debit.debit')->with('patients', $patients);
    }

    public function debit(Patient $patient) {
        $patient->debit = true;
        $patient->quanlity = 0;
        $patient->save();
        return redirect()->back();
    }

    public function Undevit(Patient $patient) {
        $patient->debit = false;
        $patient->save();
        return redirect()->back();
    }
}
