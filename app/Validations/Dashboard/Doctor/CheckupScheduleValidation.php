<?php

namespace App\Validations\Dashboard\Doctor;

use Illuminate\Support\Facades\Crypt;

use App\Helpers\FormatterCustom;

use App\Models\CheckupSchedule;
use App\Models\Doctor;

class CheckupScheduleValidation
{
    /**
     * Update validation.
     *
     * @param  $request
     * @return ArrayObject
     */
    public function update($request)
    {
        $id = Crypt::decrypt($request->id);

        $doctor = Doctor::firstWhere('user_id', $id);

        // * Cek apakah hari di jadwal periksa sama dengan hari ini
        $checkupSchedule = CheckupSchedule::firstWhere('doctor_id', $doctor->id);

        $day = date('l');
        $day = FormatterCustom::changeDayIndo($day);

        if ($checkupSchedule->day == $day) {
            $status = false;
            $statusAlert = 'fail';
            $message = 'Tidak dapat mengubah jadwal pada hari ini !';

            $result = (object) [
                'status' => $status,
                'statusAlert' => $statusAlert,
                'message' => $message,
            ];

            return $result;
        }

        // * Ambil data jadwal periksa yang poli dan hari yang sama dengan inputan
        $checkupSchedule = CheckupSchedule::where('poli_id', $doctor->poli_id)
            ->where('day', $request->day)
            ->where('doctor_id', '!=', $doctor->id)
            ->get();

        $statusCheckupSchedule = true;
        $startTime = date('H:i:s', strtotime($request->startTime));

        // * Cek apakah ada jadwal yg tumbukan
        foreach ($checkupSchedule as $row) {
            if (($row->start_time <= $startTime) and ($row->end_time > $startTime)) {
                $statusCheckupSchedule = false;
            }
        }

        if (!$statusCheckupSchedule) {
            $status = false;
            $statusAlert = 'fail';
            $message = 'Jadwal sudah digunakan !';

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
