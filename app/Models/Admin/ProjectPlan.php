<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPlan extends Model
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
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
