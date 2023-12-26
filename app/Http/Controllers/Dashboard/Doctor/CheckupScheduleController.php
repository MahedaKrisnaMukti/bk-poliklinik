<?php

namespace App\Http\Controllers\Dashboard\Doctor;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CheckupScheduleController extends Controller
{
    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.doctor.checkup-schedule.index', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
        ]);
    }
}
