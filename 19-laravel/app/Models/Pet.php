<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{

    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'image',
        'kind',
        'weight',
        'age',
        'breed',
        'location',
        'description',
        'active',
        'adopted'
    ];

    // Search by Scope
    public function scopenames($query, $q) {
        if (trim($q)) {
            return $query->where('name', 'LIKE', "%$q%")
                  ->orWhere('breed', 'LIKE', "%$q%")
                  ->orWhere('kind', 'LIKE', "%$q%");
        }
        return $query;
    }

    //Relationships
    // Pet has one adoption
    public function adoption(){
        return $this->hasOne(Adoption::class);
    }
}
