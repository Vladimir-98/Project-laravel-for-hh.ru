<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'project_id',
        'image',
        'image_medium',
        'image_alt',
        'title_en',
        'title_tr',
        'title_ru',
        'description_en',
        'description_tr',
        'description_ru',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
