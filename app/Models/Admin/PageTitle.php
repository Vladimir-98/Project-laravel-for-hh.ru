<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_title_one_en',
        'page_title_one_tr',
        'page_title_one_ru',
        'page_title_two_en',
        'page_title_two_tr',
        'page_title_two_ru',
        'page_title_three_en',
        'page_title_three_tr',
        'page_title_three_ru',
        'page_title_four_en',
        'page_title_four_tr',
        'page_title_four_ru',
        'page_title_five_en',
        'page_title_five_tr',
        'page_title_five_ru',
        'page_title_gable_id',
        'page_title_gable_type',
    ];

}
