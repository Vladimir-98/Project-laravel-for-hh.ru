<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'project_id',
        'image',
        'image_alt',
        'title_img_en',
        'title_img_tr',
        'title_img_ru',
        'date'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
