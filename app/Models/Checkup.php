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
    protected $with = ['poliList'];

    /**
     * Relationship with polilist.
     *
     * @return relationship
     */
    public function poliList()
    {
        return $this->belongsTo(PoliList::class, 'poli_list_id', 'id');
    }
}
