<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_tr',
        'name_ru',
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    /**
     * @return HasManyThrough
     */

    public function projects(): HasManyThrough
    {
        return $this->hasManyThrough(Project::class, District::class, 'city_id', 'district_id');
    }

}
