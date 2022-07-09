<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_design_en',
        'title_design_tr',
        'title_design_ru',
        'design_img_one',
        'design_img_one_alt',
        'design_img_two',
        'design_img_two_alt',
        'design_img_three',
        'design_img_three_alt',
        'design_img_four',
        'design_img_four_alt',
        'design_img_five',
        'design_img_five_alt',
        'design_gable_id',
        'design_gable_type',
    ];


}
