<?php

namespace App\Services\Dashboard\Admin;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Patient;
use App\Models\User;

class PatientService
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
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($data);

        $user->assignRole('Dokter');

        $data = [
            'user_id' => $user->id,
            'name' => $request->name,
            'address' => $request->address,
            'identity_card_number' => $request->identity_card_number,
            'phone_number' => $request->phone_number,
        ];

        Patient::create($data);

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

        $patient = Patient::firstWhere('id', $id);

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'patient' => $patient,
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

        $patient = patient::firstWhere('id', $id);

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'patient' => $patient,
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

        $patient = Patient::firstWhere('id', $id);
        $user = User::firstWhere('id', $patient->user_id);

        $data = [
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $user->id)->update($data);

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'identity_card_number' => $request->identity_card_number,
            'phone_number' => $request->phone_number,
        ];

        Patient::where('id', $id)->update($data);

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

        Patient::where('id', $id)->delete();

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
        $patient = Patient::orderBy('name', 'asc')->get();

        $patient = DataTables::of($patient)
            ->addColumn('action', function ($row) {
                $id = Crypt::encrypt($row->id);

                $show =
                    <<<EOF
                    <a href="/admin/pasien/$id">
                        <button class="btn btn-gradient-info">
                            <i class="bi bi-search"></i>
                        </button>
                    </a>
                    EOF;

                $edit =
                    <<<EOF
                    <a href="/admin/pasien/$id/edit">
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
            'patient' => $patient,
        ];

        return $result;
    }
}
