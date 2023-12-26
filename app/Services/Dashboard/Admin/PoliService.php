<?php

namespace App\Services\Dashboard\Admin;

use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Poli;

class PoliService
{
    /**
     * Store service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function store($request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        Poli::create($data);

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

    /**
     * Edit service.
     *
     * @param  $id
     * @return ArrayObject
     */
    public function edit($id)
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
            'name' => $request->name,
            'description' => $request->description,
        ];

        Poli::where('id', $id)->update($data);

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

        Poli::where('id', $id)->delete();

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
        $poli = Poli::orderBy('name', 'asc')->get();

        $poli = DataTables::of($poli)
            ->addColumn('action', function ($row) {
                $id = Crypt::encrypt($row->id);

                $show =
                    <<<EOF
                    <a href="/admin/poli/$id">
                        <button class="btn btn-gradient-info">
                            <i class="bi bi-search"></i>
                        </button>
                    </a>
                    EOF;

                $edit =
                    <<<EOF
                    <a href="/admin/poli/$id/edit">
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
            'poli' => $poli,
        ];

        return $result;
    }
}
