<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentsImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'post',
        'post_small',
        'post_alt',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartments::class);
    }
}
