<?php

namespace App\Services\Dashboard\Doctor;

use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

use App\Functions\CartFunction;

use App\Models\Checkup;
use App\Models\CheckupDetail;
use App\Models\CheckupSchedule;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\PoliRegister;

class PatientListService
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
     * Edit service.
     *
     * @param  $id
     * @return ArrayObject
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $poliRegister = PoliRegister::firstWhere('id', $id);

        $checkup = Checkup::firstWhere('poli_register_id', $poliRegister->id);

        $checkupDetail = [];

        $medicine = Medicine::orderBy('name', 'asc')->get();

        if ($checkup) {
            $checkupDetail = CheckupDetail::where('checkup_id', $checkup->id)->get();
        }

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

    /**
     * Update service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function update($request)
    {
        $id = Crypt::decrypt($request->id);

        $poliRegister = PoliRegister::firstWhere('id', $id);

        $cartResult = $this->cartFunction->getContent($poliRegister->patient_id);
        $cart = $cartResult->cart;

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

            CheckupDetail::where('checkup_id', $checkup->id)->delete();

            foreach ($cart as $row) {
                $qty = $row['quantity'];

                for ($i = 0; $i < $qty; $i++) {
                    $data = [
                        'checkup_id' => $checkup->id,
                        'medicine_id' => $row['attributes']['id_original'],
                    ];

                    CheckupDetail::create($data);
                }
            }
        } else {
            $data = [
                'poli_register_id' => $id,
                'checkup_fee' => 150000,
                'note' => $request->note,
            ];

            $checkup = Checkup::create($data);

            foreach ($cart as $row) {
                $qty = $row['quantity'];

                for ($i = 0; $i < $qty; $i++) {
                    $data = [
                        'checkup_id' => $checkup->id,
                        'medicine_id' => $row['attributes']['id_original'],
                    ];

                    CheckupDetail::create($data);
                }
            }
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
                        <button class="btn btn-success">
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

    /**
     * Add medicine service.
     *
     * @param  $request
     * @return  ArrayObject
     */
    function addMedicine($request)
    {
        $itemId = $request->id;
        $patientId = $request->patientId;

        $result = $this->cartFunction->checkItem($patientId, $itemId);

        if ($result->status) {
            $item = $result->item;
            $quantity = $item->quantity + 1;

            $data = [
                'quantity' => [
                    'relative' => false,
                    'value' => $quantity
                ],
            ];

            $result = $this->cartFunction->update($patientId, $itemId, $data);
        } else {
            $medicine = Medicine::firstWhere('id', $itemId);

            $data = [
                'id' => $request->id,
                'name' => $medicine->name,
                'price' => $medicine->price,
                'quantity' => 1,
                'attributes' => [
                    'id_original' => $medicine->id,
                ],
            ];

            $result = $this->cartFunction->add($patientId, $data);
        }

        $status = $result->status;
        $message = $result->message;

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Remove medicine service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function removeMedicine($request)
    {
        $itemId = $request->id;
        $patientId = $request->patientId;

        $result = $this->cartFunction->checkItem($patientId, $itemId);

        if ($result->status) {
            $item = $result->item;
            $quantity = $item->quantity - 1;

            if ($quantity >= 1) {
                $data = [
                    'quantity' => [
                        'relative' => false,
                        'value' => $quantity
                    ],
                ];

                $result = $this->cartFunction->update($patientId, $itemId, $data);
            } else {
                $result = $this->cartFunction->remove($patientId, $itemId);
            }
        }

        $status = $result->status;
        $message = $result->message;

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
