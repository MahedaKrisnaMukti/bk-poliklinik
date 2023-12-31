<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckupSchedule extends Model
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
    protected $with = ['doctor', 'poli'];

    /**
     * Relationship with doctor.
     *
     * @return relationship
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    /**
     * Relationship with poli.
     *
     * @return relationship
     */
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id', 'id');
    }
}
