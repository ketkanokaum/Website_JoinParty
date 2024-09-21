<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Party;
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
        $activeParties = Party::where('date', '>', date('Y-m-d H:i:s', $time))->get();
        // ดึงปาร์ตี้ที่หมดเวลารับสมัครแล้ว (วันที่อยู่ในอดีต)
        $pastParties= Party::where('date', '<=', date('Y-m-d H:i:s', $time))->get();

    return view('dashboard', [ 'activeParties' => $activeParties, 'pastParties' => $pastParties ]);  
}

public function viewPartyDetails($id){
    $parties = Party::find($id);
    return view('detailparty', compact('parties'));
}

    }


