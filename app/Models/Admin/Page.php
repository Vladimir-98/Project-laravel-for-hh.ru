<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\MorphOne;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name_page',
    ];

    /**
     * Получить about block.
     */
    public function header(): MorphOne
    {
        return $this->morphOne(Header::class, 'header_gable');
    }

    public function about(): MorphOne
    {
        return $this->morphOne(About::class, 'about_gable');
    }

    public function reviews(): MorphOne
    {
        return $this->morphOne(PageReview::class, 'review_gable');
    }

    public function pageReviews()
    {
        return $this->morphMany(Review::class, 'review_gable');
    }

    public function meta(): MorphOne
    {
        return $this->morphOne(Meta::class, 'meta_gable');
    }

    public function title(): MorphOne
    {
        return $this->morphOne(PageTitle::class, 'page_title_gable');
    }

    public function design(): MorphOne
    {
        return $this->morphOne(Design::class, 'design_gable');
    }

    public function map(): MorphOne
    {
        return $this->morphOne(Map::class, 'map_gable');
    }

    public function image()
    {
        return $this->hasOne(PageImage::class, 'page_id', 'id');
    }

    public function sliders()
    {
        return $this->hasMany(PageSlider::class, 'page_id', 'id');
    }

    public function video()
    {
        return $this->hasOne(PageVideo::class, 'page_id', 'id');
    }
}
