<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLayoutDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title_en',
        'title_tr',
        'title_ru',
        'description_en',
        'description_tr',
        'description_ru',
    ];

}
