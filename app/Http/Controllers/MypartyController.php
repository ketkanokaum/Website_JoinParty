<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Party;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
class MypartyController extends Controller
{
    public function index()
    {
        $myparty = attendance::with('party')->where('user_id', Auth::id())->get();
        return view('myparty', compact('myparty'));
    }

    public function joinAttendance(Request $request, $id){
        
        $party = Party::findOrFail($id);
        $joinAttendance = attendance::where('user_id', Auth::id())->where('party_id', $id)->first();

        if (!$joinAttendance) {
            $newAttendance = new Attendance();
            $newAttendance->user_id = Auth::id();
            $newAttendance->party_id = $id; 
            $newAttendance->joined_at = now(); 
            $newAttendance->save(); 
    
            return redirect()->route('myparty')->with('success', 'เข้าร่วมกิจกรรมเรียบร้อยแล้ว');
        }
    
        // ถ้าผู้ใช้ได้เข้าร่วมกิจกรรมแล้ว ไม่ต้องบันทึกใหม่
        return redirect()->route('myparty')->with('info', 'คุณได้เข้าร่วมกิจกรรมนี้แล้ว');
    }

    public function reviews(Request  $request){
        $request->validate([
            'party_id' => 'required|exists:parties,id', 
            'rating' => 'required|integer|min:1|max:5',   // ค่า rating ต้องอยู่ในช่วง 1-5
            'review' => 'required|string|max:1000',       // ความคิดเห็นต้องไม่เกิน 1000 ตัวอักษร
        ]);
        $review = new Review();
        $review->party_id = $request->party_id;
        $review->user_id = auth()->id();
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();
    
        return redirect()->route('myparty')->with('success', 'รีวิวของคุณถูกส่งเรียบร้อยแล้ว');

    }

}

