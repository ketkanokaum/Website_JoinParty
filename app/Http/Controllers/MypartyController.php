<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Party;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MypartyController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $myparty = Attendance::with('party')
            ->where('user_id', Auth::id())
            ->get();

        $upcomingParties = Attendance::with('party')
            ->where('user_id', Auth::id())
            ->whereHas('party', function ($query) {
                $query->where('end_date', '>', now());
            })
            ->get();

        $pastParties = Attendance::with('party')
            ->where('user_id', Auth::id())
            ->whereHas('party', function ($query) {
                $query->where('end_date', '<=', now());
            })
            ->get();

            $userReviews = Review::whereHas('attendance', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })->get()->keyBy('party_id'); 
    
            $reviews = Review::with('party', 'attendance.user')
                            ->whereHas('party')
                            ->get();
            $avg_ratings = Review::select('party_id', DB::raw('avg(rating) as average_rating'))
                ->groupBy('party_id')
                ->get()
                ->keyBy('party_id');
        
            return view('myparty', compact('myparty', 'upcomingParties', 'pastParties', 'reviews', 'avg_ratings', 'userReviews'));
        }
    
    

    public function joinAttendance(Request $request, $id)
    {

        $party = Party::findOrFail($id);
        $joinAttendance = Attendance::where('user_id', Auth::id())
            ->where('party_id', $id)->first();

        if (!$joinAttendance) {
            $newAttendance = new Attendance();
            $newAttendance->user_id = Auth::id();
            $newAttendance->party_id = $id;
            $newAttendance->joined_at = now();
            $newAttendance->save();

            return redirect()->route('myparty');
        }
    }

    public function deleteJoin($id)
    {
        $attendance = Attendance::find($id);
        if ($attendance) {
            $attendance->delete(); 
            $attendance->status = 'canceled';
            $attendance->save();  
            return redirect('/myparty')->with('success', 'คุณได้ยกเลิกการเข้าร่วมกิจกรรมเรียบร้อยแล้ว');
        }
    
        return redirect('/myparty')->with('error', 'ไม่พบข้อมูลการเข้าร่วม');
    }
}
