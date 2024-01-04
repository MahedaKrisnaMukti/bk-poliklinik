<?php

namespace App\Services\Dashboard\MainMenu;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;

class MainMenuService
{
    /**
     * Profile service.
     *
     * @return ArrayObject
     */
    public function profile()
    {
        $userId = auth()->user()->id;

        $user = User::firstWhere('id', $userId);

        $admin = null;
        $doctor = null;
        $patient = null;
        $view = null;

        if ($user->role == 'Admin') {
            $admin = Admin::firstWhere('user_id', $user->id);
            $view = 'dashboard.main-menu.profile-admin';
        } else if ($user->role == 'Dokter') {
            $doctor = Doctor::firstWhere('user_id', $user->id);
            $view = 'dashboard.main-menu.profile-doctor';
        } else if ($user->role == 'Pasien') {
            $patient = Patient::firstWhere('user_id', $user->id);
            $view = 'dashboard.main-menu.profile-patient';
        }

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'user' => $user,
            'admin' => $admin,
            'doctor' => $doctor,
            'patient' => $patient,
            'view' => $view,
        ];

        return $result;
    }

    /**
     * Update profile service.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function updateProfile($request)
    {
        $userId = auth()->user()->id;

        $user = User::firstWhere('id', $userId);

        if ($user->role == 'Dokter') {
            $data = [
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phoneNumber,
            ];

            Doctor::where('user_id', $user->id)->update($data);
        } else if ($user->role == 'Admin') {
            $data = [
                'name' => $request->name,
                'phone_number' => $request->phoneNumber,
            ];

            Admin::where('user_id', $user->id)->update($data);
        } else if ($user->role == 'Pasien') {
            $data = [
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phoneNumber,
            ];

            Patient::where('user_id', $user->id)->update($data);
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
}
