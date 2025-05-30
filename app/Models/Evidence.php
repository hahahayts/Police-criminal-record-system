<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    /** @use HasFactory<\Database\Factories\EvidenceFactory> */
    use HasFactory;

    protected $guarded = [];

    public function crime()
    {
        return $this->belongsTo(Crime::class);
    }   
}
