<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Party extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'parties';



    public function attendees(){  //ปาร์ตี้กับuser
        return $this->belongsToMany(User::class, 'attendances','party_id', 'user_id')
                    ->withTimestamps();
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function partyType()
{
    return $this->belongsTo(PartyType::class);
}

}