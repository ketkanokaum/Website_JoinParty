<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id'); // เชื่อมโยงกับ User
    }

    public function party() {
        return $this->belongsTo(Party::class, 'party_id', 'id'); // เชื่อมโยงกับ Party
    }
}
