<?php

namespace App\Services\Dashboard\Doctor;

use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

use App\Helpers\FormatterCustom;

use App\Models\Checkup;
use App\Models\CheckupDetail;
use App\Models\CheckupSchedule;
use App\Models\Doctor;
use App\Models\PoliRegister;

class PatientHistoryService
{
    /**
     * Show service.
     *
     * @param  $id
     * @return ArrayObject
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);

        $poliRegister = PoliRegister::firstWhere('id', $id);

        $checkup = Checkup::firstWhere('poli_register_id', $poliRegister->id);

        $checkupDetail = CheckupDetail::firstWhere('checkup_id', $checkup->id);

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'poliRegister' => $poliRegister,
            'checkup' => $checkup,
            'checkupDetail' => $checkupDetail,
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
            $poliRegister = PoliRegister::where('status', 'Sudah Diperiksa')
                ->where('checkup_schedule_id', $checkupSchedule->id)
                ->orderBy('queue_number', 'asc')
                ->get();
        }

        $poliRegister = DataTables::of($poliRegister)
            ->addColumn('poliRegisterDateCustom', function ($row) {
                $menu = FormatterCustom::formatDate($row->poli_register_date);

                return $menu;
            })
            ->addColumn('medicalRecordNumberCustom', function ($row) {
                $menu = $row->patient->medical_record_number;

                return $menu;
            })
            ->addColumn('patientNameCustom', function ($row) {
                $menu = $row->patient->name;

                return $menu;
            })
            ->addColumn('noteCustom', function ($row) {
                $checkup = Checkup::firstWhere('poli_register_id', $row->id);

                $menu = $checkup->note;

                return $menu;
            })
            ->addColumn('medicineNameCustom', function ($row) {
                $checkup = Checkup::firstWhere('poli_register_id', $row->id);

                $checkupDetail = CheckupDetail::firstWhere('checkup_id', $checkup->id);

                $menu = $checkupDetail->medicine->name;

                return $menu;
            })
            ->addColumn('feeCustom', function ($row) {
                $checkup = Checkup::firstWhere('poli_register_id', $row->id);

                $checkupDetail = CheckupDetail::firstWhere('checkup_id', $checkup->id);

                $menu = $checkup->checkup_fee + $checkupDetail->medicine->price;

                $menu = FormatterCustom::formatNumber($menu, true);

                return $menu;
            })
            ->addColumn('action', function ($row) {
                $id = Crypt::encrypt($row->id);

                $show =
                    <<<EOF
                    <a href="/dokter/riwayat-pasien/$id">
                        <button class="btn btn-gradient-info">
                            <i class="bi bi-search"></i>
                        </button>
                    </a>
                    EOF;


                $menu = $show;

                return $menu;
            })
            ->rawColumns([
                'poliRegisterDateCustom',
                'medicalRecordNumberCustom',
                'patientNameCustom',
                'noteCustom',
                'medicineNameCustom',
                'feeCustom',
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
