<?php

namespace App\Http\Controllers\Dashboard\Doctor;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class PatientListController extends Controller
{
    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.doctor.patient-list.index', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
        ]);
    }
}
