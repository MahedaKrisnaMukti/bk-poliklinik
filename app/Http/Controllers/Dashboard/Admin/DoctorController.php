<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Validations\Dashboard\Admin\DoctorValidation;

use App\Services\Dashboard\Admin\DoctorService;

class DoctorController extends Controller
{
    /**
     * Validation instance.
     *
     * @var \App\Validations\Dashboard\Admin\DoctorValidation
     */
    protected $doctorValidation;

    /**
     * Service instance.
     *
     * @var \App\Services\Dashboard\Admin\DoctorService
     */
    protected $doctorService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(DoctorValidation $doctorValidation, DoctorService $doctorService)
    {
        $this->doctorValidation = $doctorValidation;
        $this->doctorService = $doctorService;
    }

    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.doctor.index', [
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
        $result = $this->doctorService->create();

        return view('dashboard.admin.doctor.create', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
            'poli' => $result->poli,
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
        $validation = $this->doctorValidation->store($request);

        if (!$validation->status) {
            return redirect()->back()->with($validation->statusAlert, $validation->message);
        }

        $result = $this->doctorService->store($request);

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
        $result = $this->doctorService->show($id);

        return view('dashboard.admin.doctor.show', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
            'doctor' => $result->doctor,
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
        $result = $this->doctorService->edit($id);

        return view('dashboard.admin.doctor.edit', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
            'doctor' => $result->doctor,
            'poli' => $result->poli,
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
        $validation = $this->doctorValidation->update($request);

        if (!$validation->status) {
            return redirect()->back()->with($validation->statusAlert, $validation->message);
        }

        $result = $this->doctorService->update($request);

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
        $result = $this->doctorService->destroy($id);

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
        $result = $this->doctorService->datatable();

        return $result->doctor;
    }
}
