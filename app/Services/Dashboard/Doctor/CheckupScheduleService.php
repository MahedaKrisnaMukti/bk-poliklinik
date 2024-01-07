<?php

namespace App\Services\Dashboard\Doctor;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;

use App\Models\CheckupSchedule;
use App\Models\Doctor;

class CheckupScheduleService
{
    /**
     * Index service.
     *
     * @return ArrayObject
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $doctor = Doctor::firstWhere('user_id', $userId);

        $checkupSchedule = CheckupSchedule::firstWhere('doctor_id', $doctor->id);

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'checkupSchedule' => $checkupSchedule,
        ];

        return $result;
    }

    /**
     * Store service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function store($request)
    {
        $userId = auth()->user()->id;

        $doctor = Doctor::firstWhere('user_id', $userId);

        $data = [
            'doctor_id' => $doctor->id,
            'poli_id' => $doctor->poli_id,
            'day' => $request->day,
            'start_time' => $request->startTime,
            'end_time' => $request->endTime,
            'status' => $request->status,
        ];

        CheckupSchedule::create($data);

        $status = true;
        $statusAlert = 'success';
        $message = 'Data berhasil dibuat';

        $result = (object) [
            'status' => $status,
            'statusAlert' => $statusAlert,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Edit service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $checkupSchedule = CheckupSchedule::firstWhere('id', $id);

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'checkupSchedule' => $checkupSchedule,
        ];

        return $result;
    }

    /**
     * Update service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function update($request)
    {
        $id = Crypt::decrypt($request->id);

        $data = [
            'day' => $request->day,
            'start_time' => $request->startTime,
            'end_time' => $request->endTime,
            'status' => $request->status,
        ];

        CheckupSchedule::where('id', $id)->update($data);

        $status = true;
        $statusAlert = 'success';
        $message = 'Data berhasil diubah';

        $result = (object) [
            'status' => $status,
            'statusAlert' => $statusAlert,
            'message' => $message,
        ];

        return $result;
    }

    /*
    |--------------------------------------------------------------------------
    | Ajax
    |--------------------------------------------------------------------------
    */

    /**
     * Datatable service.
     *
     * @return  ArrayObject
     */
    public function datatable()
    {
        $userId = auth()->user()->id;
        $doctor = Doctor::firstWhere('user_id', $userId);
        $checkupSchedule = CheckupSchedule::where('doctor_id', $doctor->id)->get();

        $checkupSchedule = DataTables::of($checkupSchedule)
            ->addColumn('doctorNameCostum', function ($row) {
                $menu = $row->doctor->name;

                return $menu;
            })
            ->addColumn('action', function ($row) {
                $id = Crypt::encrypt($row->id);

                $edit =
                    <<<EOF
                    <a href="/dokter/jadwal-periksa/$id/edit">
                        <button class="btn btn-success">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </a>
                    EOF;

                $menu =$edit;

                return $menu;
            })
            ->rawColumns([
                'doctorNameCostum',
                'action',
            ])
            ->make(true);

        $status = true;
        $message = 'Data berhasil diambil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'checkupSchedule' => $checkupSchedule,
        ];

        return $result;
    }
}
