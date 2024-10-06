<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function party() {
        return $this->belongsTo(Party::class);
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id','id');
    }
    

}
