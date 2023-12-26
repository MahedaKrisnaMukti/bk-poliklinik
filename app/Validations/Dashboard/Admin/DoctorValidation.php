<?php

namespace App\Validations\Dashboard\Admin;

use Illuminate\Support\Facades\Crypt;

use App\Models\Doctor;
use App\Models\User;

class DoctorValidation
{
    /**
     * Strore validation.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function store($request)
    {
        // * Cek email ada atau tidak
        $user = User::firstWhere('email', $request->email);

        if (!empty($user)) {
            $status = false;
            $statusAlert = 'fail';
            $message = 'Email sudah digunakan !';

            $result = (object) [
                'status' => $status,
                'statusAlert' => $statusAlert,
                'message' => $message,
            ];

            return $result;
        }

        // * Jika validasi benar semua
        $status = true;
        $message = 'Validasi berhasil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Update validation.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function update($request)
    {
        // * Cek email ada atau tidak
        $id = Crypt::decrypt($request->id);

        $doctor = Doctor::firstWhere('id', $id);

        $user = User::where('email', $request->email)
            ->where('id', '!=', $doctor->user_id)
            ->first();

        if (!empty($user)) {
            $status = false;
            $statusAlert = 'fail';
            $message = 'Email sudah digunakan !';

            $result = (object) [
                'status' => $status,
                'statusAlert' => $statusAlert,
                'message' => $message,
            ];

            return $result;
        }

        // * Jika validasi benar semua
        $status = true;
        $message = 'Validasi berhasil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
