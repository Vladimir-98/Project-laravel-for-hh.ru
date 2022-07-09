<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsLayoutSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'project_id',
        'image',
        'image_alt',
        'layout',
        'balcony',
        'quadrature',
        'bathroom'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
