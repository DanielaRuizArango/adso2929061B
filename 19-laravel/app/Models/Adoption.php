<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
     protected $fillable = [
        'user_id',
        'pet_id'

    ];
}

