<?php

namespace App\Services\Dashboard\Admin;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Doctor;
use App\Models\Poli;
use App\Models\User;

class DoctorService
{
    /**
     * Store service.
     *
     * @param  $request
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

    public function store($request)
    {
        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($data);

        $user->assignRole('Dokter');

        $data = [
            'user_id' => $user->id,
            'poli_id' => $request->poliId,
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phoneNumber,
        ];

        Doctor::create($data);

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

        $doctor = Doctor::firstWhere('id', $id);

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'doctor' => $doctor,
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

        $doctor = Doctor::firstWhere('id', $id);

        $poli = Poli::orderBy('name', 'asc')->get();

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'doctor' => $doctor,
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

        $doctor = Doctor::firstWhere('id', $id);
        $user = User::firstWhere('id', $doctor->user_id);

        $data = [
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $user->id)->update($data);

        $data = [
            'poli_id' => $request->poliId,
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phoneNumber,
        ];

        Doctor::where('id', $id)->update($data);

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

        Doctor::where('id', $id)->delete();

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
        $doctor = Doctor::orderBy('name', 'asc')->get();

        $doctor = DataTables::of($doctor)
            ->addColumn('poliCustom', function ($row) {
                $menu = $row->poli->name;

                return $menu;
            })
            ->addColumn('action', function ($row) {
                $id = Crypt::encrypt($row->id);

                $show =
                    <<<EOF
                    <a href="/admin/dokter/$id">
                        <button class="btn btn-gradient-info">
                            <i class="bi bi-search"></i>
                        </button>
                    </a>
                    EOF;

                $edit =
                    <<<EOF
                    <a href="/admin/dokter/$id/edit">
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
            'doctor' => $doctor,
        ];

        return $result;
    }
}
