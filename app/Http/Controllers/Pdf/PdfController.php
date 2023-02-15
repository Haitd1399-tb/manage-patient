<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;


class PdfController extends Controller
{
    public function index(Patient $patient, Request $request)
    {
        dd($request->all());
        $money_Drugs = $request->totalMoney_Drugs;
        $money_Advances = $request->totalMoney_Advances;
        $datePay = Carbon::now('Asia/Ho_Chi_Minh');
        $data = [
            'money_Drugs'     => $money_Drugs,
            'money_Advances' => $money_Advances,
            'datePay'  => $datePay,
            'patient' => $patient
        ];

        $pdf = PDF::loadView('pdfs.pdf', compact('data'));
        return $pdf->download('Hoadon.pdf');
    }
}
