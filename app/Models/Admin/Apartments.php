<?php

namespace App\Models\Admin;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Apartments extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'id',
        'project_id',
        'city_id',
        'district_id',
//        'property_type',
        'age',
        'quadrature',
        'status',
        'floor',
        'floors',
        'sea',
        'gas',
        'layout',
        'price',
        'аidat',
        'balcony',
        'bathroom',
        'bedroom',
        'kitchen',
        'furniture',
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
        return $this->hasOne(ApartmentsImages::class, 'apartment_id');
    }

    public function city()
    {
        return $this->belongsToThrough(City::class, District::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

    public function sliders()
    {
        return $this->hasMany(ApartmentsSlider::class, 'apartment_id');
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
}
