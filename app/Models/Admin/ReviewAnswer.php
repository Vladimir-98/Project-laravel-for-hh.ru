<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_id',
        'answer',
        'user_id'
    ];

    public function review()
    {
        return $this->belongsTo(ProjectReview::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
