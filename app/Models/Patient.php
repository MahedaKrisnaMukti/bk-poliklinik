<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
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
    protected $with = ['user'];

    /**
     * Relationship with user.
     *
     * @return relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Create code after created.
     *
     * @return string
     */
    public static function booted()
    {
        static::created(function ($data) {
            $prefix = '';
            $n = strlen($data->id);
            $different = 3 - $n;

            if ($different > 0) {
                for ($i = 0; $i < $different; $i++) {
                    $prefix = $prefix . '0';
                }
            }

            $medicalRecordNumber = date('Ym') . '-' . $prefix . $data->id;

            $data->medical_record_number = $medicalRecordNumber;

            $data->save();
        });
    }
}
