<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'post',
        'post_small',
        'post_alt',
        'youtube',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
