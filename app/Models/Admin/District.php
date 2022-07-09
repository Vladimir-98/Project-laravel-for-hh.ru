<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_tr',
        'name_ru',
        'city_id',
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

}
