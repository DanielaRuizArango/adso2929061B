<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
     protected $fillable = [
        'user_id',
        'pet_id'

    ];

    //RelationShip 
    //Adoption belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //Adoption belongs to Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}




