<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\Favorite;
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
    if ($request->has('images')) {
        $users->images = $request->images;
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

    return view('dashboard', [
        'activeParties' => $activeParties,
        'pastParties' => $pastParties
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
    $party = Party::find($id);
    $isFavorite = Favorite::where('user_id', Auth::id())
                            ->where('party_id', $id)
                            ->exists(); //ตรวจสอบว่ามีรายการโปรดนี้หรือไม่
    return view('detailparty', compact('party','isFavorite'));
}

    }


