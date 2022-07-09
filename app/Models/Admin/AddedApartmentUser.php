<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddedApartmentUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'user_id',
    ];
}
