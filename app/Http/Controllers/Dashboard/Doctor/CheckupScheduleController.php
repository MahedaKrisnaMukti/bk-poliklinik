<?php

namespace App\Http\Controllers\Dashboard\Doctor;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Validations\Dashboard\Doctor\CheckupScheduleValidation;

use App\Services\Dashboard\Doctor\CheckupScheduleService;

class CheckupScheduleController extends Controller
{
    /**
     * Validation instance.
     *
     * @var \App\Validations\Dashboard\Doctor\CheckupScheduleValidation
     */
    protected $checkupScheduleValidation;

    /**
     * Service instance.
     *
     * @var \App\Services\Dashboard\Doctor\CheckupScheduleService
     */
    protected $checkupScheduleService;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(CheckupScheduleValidation $checkupScheduleValidation, CheckupScheduleService $checkupScheduleService)
    {
        $this->checkupScheduleValidation = $checkupScheduleValidation;
        $this->checkupScheduleService = $checkupScheduleService;
    }

    /**
     * Index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->checkupScheduleService->index();

        return view('dashboard.doctor.checkup-schedule.index', [
            'title' => 'BK Poliklinik',
            'description' => '',
            'keywords' => '',
            'checkupSchedule' => $result->checkupSchedule,
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
        $validation = $this->checkupScheduleValidation->update($request);

        if (!$validation->status) {
            return redirect()->back()->with($validation->statusAlert, $validation->message);
        }

        $result = $this->checkupScheduleService->update($request);

        return redirect()->back()->with($result->statusAlert, $result->message);
    }
}
