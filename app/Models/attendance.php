<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory;
    use SoftDeletes;
   

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }

    public function party() {
        return $this->belongsTo(Party::class, 'party_id', 'id'); 
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'attendance_id','id');
    }
}
