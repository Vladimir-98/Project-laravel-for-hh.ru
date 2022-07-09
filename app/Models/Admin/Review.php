<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'review',
        'status',
        'review_gable_id',
        'review_gable_type'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'review_gable_id', 'id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'review_gable_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answer()
    {
        return $this->hasOne(ReviewAnswer::class, 'review_id', 'id');
    }
}
