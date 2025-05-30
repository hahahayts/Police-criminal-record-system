<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspect extends Model
{
    /** @use HasFactory<\Database\Factories\SuspectFactory> */
    use HasFactory;

    protected $guarded = [];

     public function crime()
    {
        return $this->belongsTo(Crime::class);
    }

}
