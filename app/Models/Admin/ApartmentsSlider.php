<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentsSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'apartment_id',
        'image',
        'image_medium',
        'image_small',
        'image_alt',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartments::class);
    }
}
