<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliRegister extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['patient', 'checkupSchedule'];

    /**
     * Relationship with patient.
     *
     * @return relationship
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    /**
     * Relationship with checkup schedule.
     *
     * @return relationship
     */
    public function checkupSchedule()
    {
        return $this->belongsTo(CheckupSchedule::class, 'checkup_schedule_id', 'id');
    }

    /**
     * Create code after created.
     *
     * @return string
     */
    public static function booted()
    {
        static::created(function ($data) {
            $queueNumber = PoliRegister::where('checkup_schedule_id', $data->checkup_schedule_id)
                ->where('poli_register_date', $data->poli_register_date)
                ->count();

            $data->queue_number = $queueNumber;

            $data->save();
        });
    }
}
