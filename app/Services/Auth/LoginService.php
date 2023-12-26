<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;

class LoginService
{
    /**
     * Authenticate.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function authenticate($request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        Auth::attempt($data);

        $user = User::firstWhere('email', $request->email);

        $name = '';

        // * Jika role Admin
        if ($user->role == 'Admin') {
            $admin = Admin::firstWhere('user_id', $user->id);
            $name = $admin->name;
        }

        // * Jika role Dokter
        else if ($user->role == 'Dokter') {
            $doctor = Doctor::firstWhere('user_id', $user->id);
            $name = $doctor->name;
        }

        // * Jika role Pasien
        else if ($user->role == 'Pasien') {
            $patient = Patient::firstWhere('user_id', $user->id);
            $name = $patient->name;
        }

        $status = true;
        $statusAlert = 'toast';
        $message = 'Selamat datang ' . $name;

        $result = (object) [
            'status' => $status,
            'statusAlert' => $statusAlert,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Logout service.
     *
     * @param  $request
     * @return  ArrayObject
     */
    public function logout($request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $status = true;
        $message = 'Berhasil logout !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
