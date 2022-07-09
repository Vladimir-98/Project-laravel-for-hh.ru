<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
//        'post',
//        'post_medium',
//        'post_alt',
        'catalog',
        'catalog_medium',
        'catalog_alt',
        'logo',
        'logo_alt',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
