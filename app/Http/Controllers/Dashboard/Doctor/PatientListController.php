<?php

namespace App\Http\Controllers\Dashboard\Doctor;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\Dashboard\Doctor\PatientListService;

class PatientListController extends Controller
{
    /**
     * Service instance.
     *
     * @var \App\Services\Dashboard\Doctor\PatientListService
     */
    protected $patientListService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(PatientListService $patientListService)
    {
        $this->patientListService = $patientListService;
    }

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

    /**
     * Edit.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = $this->patientListService->edit($id);

        return view('dashboard.doctor.patient-list.edit', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
            'poliRegister' => $result->poliRegister,
            'medicine' => $result->medicine,
        ]);
    }

    /**
     * Update.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->id = $id;
        $result = $this->patientListService->update($request);

        return redirect()->back()->with($result->statusAlert, $result->message);
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
        $result = $this->patientListService->datatable();

        return $result->poliRegister;
    }
}
