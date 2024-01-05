<?php

namespace App\Services\Dashboard\Doctor;

use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

use App\Functions\CartFunction;

use App\Helpers\FormatterCustom;

use App\Models\Checkup;
use App\Models\CheckupDetail;
use App\Models\CheckupSchedule;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\PoliRegister;

class PatientHistoryService
{
    /**
     * Functions instance.
     *
     * @var \App\Functions\CartFunction
     */
    protected $cartFunction;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(CartFunction $cartFunction)
    {
        $this->cartFunction = $cartFunction;
    }

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

        $checkupDetail = CheckupDetail::where('checkup_id', $checkup->id)->get();

        $medicine = Medicine::orderBy('name', 'asc')->get();

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'poliRegister' => $poliRegister,
            'checkup' => $checkup,
            'checkupDetail' => $checkupDetail,
            'medicine' => $medicine,
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
            ->addColumn('feeCustom', function ($row) {
                $checkup = Checkup::firstWhere('poli_register_id', $row->id);

                $checkupDetail = CheckupDetail::where('checkup_id', $checkup->id)->get();

                $price = $checkup->checkup_fee;

                foreach ($checkupDetail as $rowCheckupDetail) {
                    $price = $price + $rowCheckupDetail->medicine->price;
                }

                $menu = FormatterCustom::formatNumber($price, true);

                return $menu;
            })
            ->addColumn('action', function ($row) {
                $id = Crypt::encrypt($row->id);

                $show =
                    <<<EOF
                    <a href="/dokter/riwayat-pasien/$id">
                        <button class="btn btn-info">
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
