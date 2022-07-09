<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_tr',
        'title_ru',
        'description_en',
        'description_tr',
        'description_ru',
    ];
}
