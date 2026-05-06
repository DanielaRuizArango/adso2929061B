<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'pet_id'
    ];

    //Relationships
    // Adoption belongs to user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Adoption belongs to pet
    public function pet(){
        return $this->belongsTo(Pet::class);
    }

    // Scope Names
    public function scopeNames($adoptions, $q)
    {
        if(trim($q)) {
            $adoptions
                ->where(function($adoptions) use ($q) {
                    $adoptions->whereHas('user', function($subquery) use ($q) {
                        $subquery->where('fullname', 'LIKE', "%$q%")
                            ->orWhere('email', 'LIKE', "%$q%");
                    })
                    ->orWhereHas('pet', function($subquery) use ($q) {
                        $subquery->where('name', 'LIKE', "%$q%")
                            ->orWhere('kind', 'LIKE', "%$q%");
                    });
                });
        }
        return $adoptions;
    }

}