<?php

namespace App\Services\Dashboard\Doctor;

use App\Models\CheckupSchedule;
use App\Models\Doctor;
use Illuminate\Support\Facades\Crypt;

class CheckupScheduleService
{
    /**
     * Index service.
     *
     * @return ArrayObject
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $doctor = Doctor::firstWhere('user_id', $userId);

        $checkupSchedule = CheckupSchedule::firstWhere('doctor_id', $doctor->id);

        $status = true;
        $message = 'Data berhasil diambil';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'checkupSchedule' => $checkupSchedule,
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

        $doctor = Doctor::firstWhere('user_id', $id);

        $checkupSchedule = CheckupSchedule::firstWhere('doctor_id', $doctor->id);

        if ($checkupSchedule) {
            $data = [
                'day' => $request->day,
                'start_time' => $request->startTime,
                'end_time' => $request->endTime,
            ];

            CheckupSchedule::where('doctor_id', $doctor->id)->update($data);
        } else {
            $data = [
                'doctor_id' => $doctor->id,
                'poli_id' => $doctor->poli_id,
                'day' => $request->day,
                'start_time' => $request->startTime,
                'end_time' => $request->endTime,
            ];

            CheckupSchedule::create($data);
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
