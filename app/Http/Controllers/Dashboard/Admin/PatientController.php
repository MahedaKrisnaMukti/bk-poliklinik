<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Validations\Dashboard\Admin\PatientValidation;

use App\Services\Dashboard\Admin\PatientService;

class PatientController extends Controller
{
    /**
     * Validation instance.
     *
     * @var \App\Validations\Dashboard\Admin\PatientValidation
     */
    protected $patientValidation;

    /**
     * Service instance.
     *
     * @var \App\Services\Dashboard\Admin\PatientService
     */
    protected $patientService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(PatientValidation $patientValidation, PatientService $patientService)
    {
        $this->patientValidation = $patientValidation;
        $this->patientService = $patientService;
    }

    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.patient.index', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
        ]);
    }

    /**
     * Create.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.patient.create', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
        ]);
    }

    /**
     * Store.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->patientValidation->store($request);

        if (!$validation->status) {
            return redirect()->back()->with($validation->statusAlert, $validation->message);
        }

        $result = $this->patientService->store($request);

        return redirect()->back()->with($result->statusAlert, $result->message);
    }

    /**
     * Show.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->patientService->show($id);

        return view('dashboard.admin.patient.show', [
            'title' => 'Gitarasa',
            'description' => '',
            'keywords' => '',
            'patient' => $result->patient,
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
        $result = $this->patientService->edit($id);

        return view('dashboard.admin.patient.edit', [
            'title' => 'Gitarasa',
            'description' => '',
            'keywords' => '',
            'patient' => $result->patient,
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
        $validation = $this->patientValidation->update($request);

        if (!$validation->status) {
            return redirect()->back()->with($validation->statusAlert, $validation->message);
        }

        $result = $this->patientService->update($request);

        return redirect()->back()->with($result->statusAlert, $result->message);
    }

    /**
     * Destroy.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->patientService->destroy($id);

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
        $result = $this->patientService->datatable();

        return $result->patient;
    }
}
