<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_about_en',
        'title_about_tr',
        'title_about_ru',
        'description_about_en',
        'description_about_tr',
        'description_about_ru',
        'about_img',
        'about_img_medium',
        'about_img_alt',
        'about_gable_id',
        'about_gable_type',
    ];

}
