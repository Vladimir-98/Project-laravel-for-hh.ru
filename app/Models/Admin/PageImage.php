<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'page_id',
        'image',
        'image_medium',
        'image_alt',
    ];

}
