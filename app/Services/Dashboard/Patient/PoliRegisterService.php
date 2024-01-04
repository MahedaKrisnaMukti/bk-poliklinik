<?php

namespace App\Services\Dashboard\Patient;

use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

use App\Helpers\FormatterCustom;

use App\Models\CheckupSchedule;
use App\Models\Patient;
use App\Models\Poli;
use App\Models\PoliRegister;

class PoliRegisterService
{
    /**
     * Create service.
     *
     * @return ArrayObject
     */
    public function create()
    {
        $poli = Poli::orderBy('name', 'asc')->get();

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'poli' => $poli,
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

        $patient = Patient::firstWhere('user_id', $userId);

        $data = [
            'patient_id' => $patient->id,
            'checkup_schedule_id' => $request->checkupScheduleId,
            'poli_register_date' => $request->poliRegisterDate,
            'complaint' => $request->complaint,
        ];

        PoliRegister::create($data);

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
     * Show service.
     *
     * @param  $id
     * @return ArrayObject
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);

        $poli = Poli::firstWhere('id', $id);

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'poli' => $poli,
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

        $patient = Patient::firstWhere('user_id', $userId);

        $poliRegister = PoliRegister::where("patient_id", $patient->id)
        ->orderBy('created_at', 'asc')->get();

        $poliRegister = DataTables::of($poliRegister)
            ->addColumn('poliRegisterDateCustom', function ($row) {
                $menu = FormatterCustom::formatDate($row->poli_register_date);

                return $menu;
            })
            ->addColumn('poliNameCustom', function ($row) {
                $checkupSchedule = CheckupSchedule::firstWhere('id', $row->checkup_schedule_id);

                $menu = $checkupSchedule->poli->name;

                return $menu;
            })
            ->addColumn('doctorNameCustom', function ($row) {
                $checkupSchedule = CheckupSchedule::firstWhere('id', $row->checkup_schedule_id);

                $menu = $checkupSchedule->doctor->name;

                return $menu;
            })
            ->addColumn('queueNumberCustom', function ($row) {
                $prefix = '';
                $n = strlen($row->queue_number);
                $different = 3 - $n;

                if ($different > 0) {
                    for ($i = 0; $i < $different; $i++) {
                        $prefix = $prefix . '0';
                    }
                }

                $menu = $prefix . $row->queue_number;

                return $menu;
            })
            ->addColumn('statusCustom', function ($row) {
                if ($row->status == 'Belum Diperiksa') {
                    $class = 'badge bg-danger';
                } else {
                    $class = 'badge bg-success';
                }

                $menu = '<span class="' . $class . '">' . $row->status . '</span>';

                return $menu;
            })
            ->addColumn('action', function ($row) {
                $id = Crypt::encrypt($row->id);

                $show =
                    <<<EOF
                    <a href="/pasien/mendaftar-poli/$id">
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
                'poliNameCustom',
                'doctorNameCustom',
                'queueNumberCustom',
                'statusCustom',
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

    /**
     * Check checkup schedule service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function checkCheckupSchedule($request)
    {
        $checkupSchedule = [];

        $today = date('Y-m-d');
        $hourNow = date('H:i:s');

        if ($request->poliRegisterDate >= $today) {
            $day = date('l', strtotime($request->poliRegisterDate));

            $day = FormatterCustom::changeDayIndo($day);

            $checkupSchedule = CheckupSchedule::where('poli_id', $request->poliId)
                ->where('day', $day);

            if ($request->poliRegisterDate == $today) {
                $checkupSchedule = $checkupSchedule->where('end_time', '>', $hourNow);
            }

            $checkupSchedule = $checkupSchedule->orderBy('start_time', 'asc')
                ->get();
        }

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'checkupSchedule' => $checkupSchedule,
        ];

        return $result;
    }
}
