<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectApartmentVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'video_gable_id',
        'video_gable_type',
    ];


}
