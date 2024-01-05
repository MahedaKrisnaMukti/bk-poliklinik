<?php

namespace App\Http\Controllers\Dashboard\Patient;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\Dashboard\Patient\PoliRegisterService;

class PoliRegisterController extends Controller
{
    /**
     * Service instance.
     *
     * @var \App\Services\Dashboard\Patient\PoliRegisterService
     */
    protected $poliRegisterService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(PoliRegisterService $poliRegisterService)
    {
        $this->poliRegisterService = $poliRegisterService;
    }

    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.patient.poli-register.index', [
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
        $result = $this->poliRegisterService->create();

        return view('dashboard.patient.poli-register.create', [
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
        $result = $this->poliRegisterService->store($request);

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
        $result = $this->poliRegisterService->show($id);

        return view('dashboard.patient.poli-register.show', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
            'poliRegister' => $result->poliRegister,
            'checkupSchedule' => $result->checkupSchedule,
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
        $result = $this->poliRegisterService->datatable();

        return $result->poliRegister;
    }

    /**
     * Check checkup schedule.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkCheckupSchedule(Request $request)
    {
        $result = $this->poliRegisterService->checkCheckupSchedule($request);

        return $result;
    }
}
