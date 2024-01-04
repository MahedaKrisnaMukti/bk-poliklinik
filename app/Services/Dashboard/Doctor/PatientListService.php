<?php

namespace App\Services\Dashboard\Doctor;

use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Checkup;
use App\Models\CheckupDetail;
use App\Models\CheckupSchedule;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\PoliRegister;

class PatientListService
{
    /**
     * Edit service.
     *
     * @param  $id
     * @return ArrayObject
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $poliRegister = PoliRegister::firstWhere('id', $id);

        $medicine = Medicine::orderBy('name', 'asc')->get();

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'poliRegister' => $poliRegister,
            'medicine' => $medicine,
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
            'status' => 'Sudah Diperiksa',
        ];

        PoliRegister::where('id', $id)->update($data);

        $checkup = Checkup::firstWhere("poli_register_id", $id);

        if ($checkup) {
            $data = [
                'note' => $request->note,
            ];

            Checkup::where('id', $checkup->id)->update($data);

            $data = [
                'medicine_id' => $request->medicineId,
            ];

            CheckupDetail::where('checkup_id', $checkup->id)->update($data);
        } else {
            $data = [
                'poli_register_id' => $id,
                'checkup_fee' => 150000,
                'note' => $request->note,
            ];

            $checkup = Checkup::create($data);

            $data = [
                'checkup_id' => $checkup->id,
                'medicine_id' => $request->medicineId,
            ];

            CheckupDetail::create($data);
        }

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

        $checkupSchedule = CheckupSchedule::firstWhere('doctor_id', $doctor->id);

        $poliRegister = [];

        if ($checkupSchedule) {
            $today = date('Y-m-d');

            $poliRegister = PoliRegister::where('status', 'Belum Diperiksa')
                ->where('checkup_schedule_id', $checkupSchedule->id)
                ->where('poli_register_date', $today)
                ->orderBy('queue_number', 'asc')
                ->get();
        }

        $poliRegister = DataTables::of($poliRegister)
            ->addColumn('patientNameCustom', function ($row) {
                $menu = $row->patient->name;

                return $menu;
            })
            ->addColumn('action', function ($row) {
                $id = Crypt::encrypt($row->id);

                $edit =
                    <<<EOF
                    <a href="/dokter/daftar-pasien/$id/edit">
                        <button class="btn btn-gradient-success">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </a>
                    EOF;


                $menu = $edit;

                return $menu;
            })
            ->rawColumns([
                'patientNameCustom',
                'action',
            ])
            ->make(true);

        $status = true;
        $message = 'Data berhasil diambil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'poliRegister' => $poliRegister,
        ];

        return $result;
    }
}
