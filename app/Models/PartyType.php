<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyType extends Model
{
    use HasFactory;

    public function partyType()
    {
        return $this->belongsTo(PartyType::class);
    }
}
