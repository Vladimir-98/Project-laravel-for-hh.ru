<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_tr',
        'title_ru',
        'description_en',
        'description_tr',
        'description_ru',
        'description_gable_id',
        'description_gable_type',
    ];

}
