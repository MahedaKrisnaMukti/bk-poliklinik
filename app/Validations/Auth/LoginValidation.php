<?php

namespace App\Validations\Auth;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class LoginValidation
{
    /**
     * Authenticate validation.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function authenticate($request)
    {
        // * Cek email ada atau tidak
        $user = User::firstWhere('email', $request->email);

        if (empty($user)) {
            $status = false;
            $statusAlert = 'fail';
            $message = 'Email tidak ditemukan !';

            $result = (object) [
                'status' => $status,
                'statusAlert' => $statusAlert,
                'message' => $message,
            ];

            return $result;
        }

        // * Jika email benar maka cek password benar atau tidak
        $statusPassword = Hash::check($request->password, $user->password);

        if ($statusPassword == false) {
            $status = false;
            $statusAlert = 'fail';
            $message = 'Password salah !';

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
