<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\Dashboard\Admin\PoliService;

class PoliController extends Controller
{
    /**
     * Service instance.
     *
     * @var \App\Services\Dashboard\Admin\PoliService
     */
    protected $poliService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(PoliService $poliService)
    {
        $this->poliService = $poliService;
    }

    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.poli.index', [
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
        return view('dashboard.admin.poli.create', [
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
        $result = $this->poliService->store($request);

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
        $result = $this->poliService->show($id);

        return view('dashboard.admin.poli.show', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
            'poli' => $result->poli,
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
        $result = $this->poliService->edit($id);

        return view('dashboard.admin.poli.edit', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
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
        $result = $this->poliService->update($request);

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
        $result = $this->poliService->destroy($id);

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
        $result = $this->poliService->datatable();

        return $result->poli;
    }
}
