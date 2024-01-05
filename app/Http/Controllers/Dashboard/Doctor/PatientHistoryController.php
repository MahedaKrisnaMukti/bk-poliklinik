<?php

namespace App\Http\Controllers\Dashboard\Doctor;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\Dashboard\Doctor\PatientHistoryService;

class PatientHistoryController extends Controller
{
    /**
     * Service instance.
     *
     * @var \App\Services\Dashboard\Doctor\PatientHistoryService
     */
    protected $patientHistoryService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(PatientHistoryService $patientHistoryService)
    {
        $this->patientHistoryService = $patientHistoryService;
    }

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

    /**
     * Show.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->patientHistoryService->show($id);

        return view('dashboard.doctor.patient-history.show', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
            'poliRegister' => $result->poliRegister,
            'checkup' => $result->checkup,
            'checkupDetail' => $result->checkupDetail,
            'medicine' => $result->medicine,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Ajax
    |--------------------------------------------------------------------------
    */

    /**
     * Datatable.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        $result = $this->patientHistoryService->datatable();

        return $result->poliRegister;
    }
}
