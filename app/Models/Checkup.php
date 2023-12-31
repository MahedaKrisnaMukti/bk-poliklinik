<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
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
    protected $with = ['poliRegister'];

    /**
     * Relationship with poli register.
     *
     * @return relationship
     */
    public function poliRegister()
    {
        return $this->belongsTo(PoliRegister::class, 'poli_register_id', 'id');
    }
}
