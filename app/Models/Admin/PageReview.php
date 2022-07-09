<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_review_en',
        'title_review_tr',
        'title_review_ru',
        'description_review_en',
        'description_review_tr',
        'description_review_ru',
        'review_gable_id',
        'review_gable_type',
    ];

}
