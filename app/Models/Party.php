<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Party extends Model
{
    use HasFactory;
    use softDeletes;

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

    public function attendees(){  //ปาร์ตี้กับuser
        return $this->belongsToMany(User::class, 'attendances')
                    ->withTimestamps();
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}