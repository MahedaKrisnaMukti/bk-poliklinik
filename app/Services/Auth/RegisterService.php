<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Hash;

use App\Models\Patient;
use App\Models\User;

class RegisterService
{
    /**
     * Authenticate.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function registration($request)
    {
        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($data);

        $user->assignRole('Pasien');

        $data = [
            'user_id' => $user->id,
            'name' => $request->name,
            'address' => $request->address,
            'identity_card_number' => $request->identityCardNumber,
            'phone_number' => $request->phoneNumber,
        ];

        Patient::create($data);

        $status = true;
        $statusAlert = 'success';
        $message = 'Registrasi berhasil !';

        $result = (object) [
            'status' => $status,
            'statusAlert' => $statusAlert,
            'message' => $message,
        ];

        return $result;
    }
}
