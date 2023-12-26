<?php

namespace App\Validations\Auth;

use App\Models\Patient;
use App\Models\User;

class RegisterValidation
{
    /**
     * Registration validation.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function registration($request)
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

        // * Cek ktp ada atau tidak
        $patient = Patient::firstWhere('identity_card_number', $request->identityCardNumber);

        if (!empty($patient)) {
            $status = false;
            $statusAlert = 'fail';
            $message = 'Nomor KTP sudah digunakan !';

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
