<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
class ManageController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        return view('profile_user',compact('user'));
    }

    public function showEditProfile()
    {
        $users = User::all();
        return view('profile_user', compact('users'));
    }

    public function UpdateProfile(Request $request, $id){
        $users = User::find($id);
    if ($request->has('username')) {
        $users->username = $request->username;
    }
    if ($request->has('fristname')) {
        $users->fristname = $request->fristname;
    }
    if ($request->has('lastname')) {
        $users->lastname = $request->lastname;
    }
    if ($request->has('gender')) {
        $users->gender = $request->gender;
    }
    if ($request->has('birthday')) {
        $users->birthday = $request->birthday;
    }
    if ($request->has('phone')) {
        $users->phone = $request->phone;
    }
    if ($request->has('Introduction')) {
        $users->Introduction = $request->Introduction;
    }
    if ($request->hasFile('img')) {
        // ตรวจสอบว่าผู้ใช้มีรูปภาพเดิมอยู่หรือไม่ และลบรูปภาพเดิมหากมี
        if ($users->img && Storage::exists('public/users_images/' . $users->img)) {
            Storage::delete('public/users_images/' . $users->img);
        }
        // สร้างชื่อไฟล์ใหม่โดยใช้เวลาปัจจุบันและนามสกุลของไฟล์
        $imageName = time() . '.' . $request->img->extension();
        // จัดเก็บไฟล์ไปยังโฟลเดอร์ที่ต้องการ โดยใช้ Storage::putFile
        $path = $request->file('img')->storeAs('public/users_images', $imageName);
        $users->img = $imageName;
        $users->save();
    }
    
    $users->save();
    return redirect()->route('profile.show');
}

public function showParty()
{
    $time = time();
    // ดึงปาร์ตี้ที่ยังไม่หมดเวลารับสมัคร (วันที่อยู่ในอนาคต)
    $activeParties = Party::where('start_date', '>', date('Y-m-d H:i:s', $time))->get();
    // ดึงปาร์ตี้ที่หมดเวลารับสมัครแล้ว (วันที่อยู่ในอดีต)
    $pastParties = Party::where('start_date', '<=', date('Y-m-d H:i:s', $time))->get();
    $joinAttendances = Attendance::where('user_id', Auth::id())->pluck('party_id')->toArray();

    return view('dashboard', [
        'activeParties' => $activeParties,
        'pastParties' => $pastParties,
        'joinAttendances' =>$joinAttendances
    ]);
}

public function searchParty(Request $request)
{
    $searchTerm = $request->input('query');
    $province = $request->input('province');

    $query = Party::query();

    if ($searchTerm) {
        $query->where('party_name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('location', 'LIKE', "%{$searchTerm}%");
    }

    if ($province) {
        $query->where('location', $province);
    }

    $parties = $query->get();

    // ตรวจสอบว่า $parties มีข้อมูลหรือไม่
    if ($parties->isEmpty()) {
        return response()->json([]);
    } else {
        return response()->json($parties);
    }
}


public function viewPartyDetails($id){
    $party = Party::findOrFail($id);
    $isFavorite = DB::table('favorites')
                ->where('user_id', Auth::id())
                ->where('party_id', $id)
                ->exists(); //ตรวจสอบว่ามีรายการโปรดนี้หรือไม่
    $joinAttendances = Attendance::where('user_id', Auth::id())->pluck('party_id')->toArray();

    return view('detailparty', compact('party','isFavorite','joinAttendances'));
}

// public function countJoin()
// {
//     $activeParties = Party::all();
//     $partiesCount = [];
//     foreach ($activeParties as $party) {
//         $partiesCount[$party->id] =  $partiesCount[$party->id] = $party->attendees()->count();

//     }
//     return view('dashboard', compact('activeParties', 'partiesCount'));
// }




    }


