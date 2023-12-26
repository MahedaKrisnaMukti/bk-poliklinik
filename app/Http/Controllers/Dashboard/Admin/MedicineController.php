<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\Dashboard\Admin\MedicineService;

class MedicineController extends Controller
{
    /**
     * Service instance.
     *
     * @var \App\Services\Dashboard\Admin\MedicineService
     */
    protected $medicineService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(MedicineService $medicineService)
    {
        $this->medicineService = $medicineService;
    }

    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.medicine.index', [
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
        return view('dashboard.admin.medicine.create', [
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
        $result = $this->medicineService->store($request);

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
        $result = $this->medicineService->show($id);

        return view('dashboard.admin.medicine.show', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
            'medicine' => $result->medicine,
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
        $result = $this->medicineService->edit($id);

        return view('dashboard.admin.medicine.edit', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
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
        $result = $this->medicineService->update($request);

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
        $result = $this->medicineService->destroy($id);

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
        $result = $this->medicineService->datatable();

        return $result->medicine;
    }
}
