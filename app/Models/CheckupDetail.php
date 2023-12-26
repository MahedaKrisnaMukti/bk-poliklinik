<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckupDetail extends Model
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
    protected $with = ['checkup', 'medicine'];

    /**
     * Relationship with checkup.
     *
     * @return relationship
     */
    public function checkup()
    {
        return $this->belongsTo(Checkup::class, 'checkup_id', 'id');
    }

    /**
     * Relationship with medicine.
     *
     * @return relationship
     */
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id', 'id');
    }
}
