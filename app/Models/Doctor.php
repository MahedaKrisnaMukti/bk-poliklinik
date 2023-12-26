<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
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
    protected $with = ['poli', 'user'];

    /**
     * Relationship with poli.
     *
     * @return relationship
     */
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id', 'id');
    }

    /**
     * Relationship with user.
     *
     * @return relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
