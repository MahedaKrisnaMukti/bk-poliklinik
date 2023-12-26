<?php

namespace App\Services\Dashboard\Admin;

use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

use App\Helpers\FormatterCustom;
use App\Models\Medicine;

class MedicineService
{
    /**
     * Store service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function store($request)
    {
        $price = FormatterCustom::parseInteger($request->price);

        $data = [
            'name' => $request->name,
            'packaging' => $request->packaging,
            'price' => $price,
        ];

        Medicine::create($data);

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

        $medicine = Medicine::firstWhere('id', $id);

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'medicine' => $medicine,
        ];

        return $result;
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

        $medicine = Medicine::firstWhere('id', $id);

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
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

        $price = FormatterCustom::parseInteger($request->price);

        $data = [
            'name' => $request->name,
            'packaging' => $request->packaging,
            'price' => $price,
        ];

        Medicine::where('id', $id)->update($data);

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

    /**
     * Destroy service.
     *
     * @param  $id
     * @return ArrayObject
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);

        Medicine::where('id', $id)->delete();

        $status = true;
        $statusAlert = 'success';
        $message = 'Data berhasil dihapus';

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
        $medicine = Medicine::orderBy('name', 'asc')->get();

        $medicine = DataTables::of($medicine)
            ->addColumn('action', function ($row) {
                $id = Crypt::encrypt($row->id);

                $show =
                    <<<EOF
                    <a href="/admin/obat/$id">
                        <button class="btn btn-gradient-info">
                            <i class="bi bi-search"></i>
                        </button>
                    </a>
                    EOF;

                $edit =
                    <<<EOF
                    <a href="/admin/obat/$id/edit">
                        <button class="btn btn-gradient-success">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </a>
                    EOF;

                $delete =
                    <<<EOF
                    <button type="button" class="btn btn-gradient-danger" onclick="confirmDelete('$id')">
                        <i class="bi bi-trash"></i>
                    </button>
                    EOF;


                $menu = $show . "\r\n" .  $edit . "\r\n" . $delete;

                return $menu;
            })
            ->rawColumns(['action'])
            ->make(true);

        $status = true;
        $message = 'Data berhasil diambil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'medicine' => $medicine,
        ];

        return $result;
    }
}
