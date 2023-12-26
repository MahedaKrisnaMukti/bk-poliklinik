<?php

namespace App\Http\Controllers\Dashboard\Doctor;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class PatientHistoryController extends Controller
{
    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.doctor.patient-history.index', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
        ]);
    }
}
