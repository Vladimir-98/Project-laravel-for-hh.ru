<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_header_en',
        'title_header_tr',
        'title_header_ru',
        'description_header_en',
        'description_header_tr',
        'description_header_ru',
        'header_img',
        'header_img_medium',
        'header_img_alt',
        'header_gable_id',
        'header_gable_type',
    ];

//    public function imageable()
//    {
//        return $this->morphTo();
//    }

}
