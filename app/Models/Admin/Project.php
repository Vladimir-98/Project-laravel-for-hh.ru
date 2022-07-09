<?php

namespace App\Models\Admin;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Project extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'city_id',
        'district_id',
        'name_en',
        'name_tr',
        'name_ru',
        'deadline',
        'floors',
        'sea',
        'gas',
        'layouts',
        'price',
        'аidat',
        'availability',
        'installments',
        'pool',
        'sauna',
        'hammam',
        'fitness',
        'relaxation',
        'barbecue',
        'sport',

    ];

    public function images()
    {
        return $this->hasOne(ProjectImage::class);
    }

    public function city()
    {
        return $this->belongsToThrough(City::class, District::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

    public function sliders()
    {
        return $this->hasMany(ProjectsSlider::class, 'project_id', 'id');
    }

    public function progressTitle()
    {
        return $this->hasOne(ProjectProgressTitle::class, 'project_id', 'id');
    }

    public function progress()
    {
        return $this->hasMany(ProjectsProgress::class, 'project_id', 'id');
    }

    public function meta(): MorphOne
    {
        return $this->morphOne(ProjectApartmentMeta::class, 'meta_gable');
    }

    public function description(): MorphOne
    {
        return $this->morphOne(Description::class, 'description_gable');
    }

    public function map(): MorphOne
    {
        return $this->morphOne(ProjectApartmentMap::class, 'map_gable');
    }

    public function video(): MorphOne
    {
        return $this->morphOne(ProjectApartmentVideo::class, 'video_gable');
    }

    public function plan()
    {
        return $this->hasOne(ProjectPlan::class, 'project_id', 'id');
    }

    public function layoutSlider()
    {
        return $this->hasMany(ProjectsLayoutSlider::class, 'project_id', 'id');
    }

    public function layoutDescription()
    {
        return $this->hasOne(ProjectLayoutDescription::class, 'project_id', 'id');
    }

    public function infrastructure()
    {
        return $this->hasOne(InfrastructureDescription::class, 'project_id', 'id');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'review_gable');
    }

    public function added()
    {
        return $this->hasMany(AddedProjectUser::class, 'project_id', 'id');
    }

    public function apartments()
    {
        return $this->hasMany(Apartments::class, 'project_id', 'id');
    }

}
