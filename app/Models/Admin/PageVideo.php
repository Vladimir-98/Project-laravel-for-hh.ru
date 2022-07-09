<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'page_id',
    ];
}
