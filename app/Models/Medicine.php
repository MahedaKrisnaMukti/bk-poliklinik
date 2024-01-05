<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    /**
     * Get the image url.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        $fileUrl = null;

        if ($this->image) {
            $url = config('s3.url');
            $fileUrl = $url . 'medicine/' . $this->image;
        }

        return $fileUrl;
    }
}
