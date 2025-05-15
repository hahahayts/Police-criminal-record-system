<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    /** @use HasFactory<\Database\Factories\CrimeFactory> */
    use HasFactory;

    protected $guarded = [];

     public function suspects()
    {
        return $this->hasMany(Suspect::class);
    }
    
    public function evidence()
    {
        return $this->hasMany(Evidence::class);
    }
}
