<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectApartmentMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_meta_en',
        'title_meta_tr',
        'title_meta_ru',
        'description_meta_en',
        'description_meta_tr',
        'description_meta_ru',
        'canonical',
        'meta_gable_id',
        'meta_gable_type',
    ];

}
