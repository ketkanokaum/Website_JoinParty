<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\Attendance;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;

class ManageController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        return view('profile_user', compact('user'));
    }


    public function UpdateProfile(Request $request, $id)
    {
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
        if ($request->hasFile('images') && $request->file('images')->isValid()) {
            
            $imagePath = $request->file('images')->store('users_images', 'public');
            $users->images = $imagePath;
        }
        
    
        $users->save();
        return redirect()->route('profile.show');
    }

    public function showParty()
    {
        $time = time();
        $activeParties = Party::where('start_date', '>', date('Y-m-d H:i:s', $time))
            ->orderBy('start_date', 'asc')
            ->get();
        $pastParties = Party::where('start_date', '<=', date('Y-m-d H:i:s', $time))->get();
        $partyCounts = Party::select('party_type_id', DB::raw('count(*) as total'))
            ->groupBy('party_type_id')
            ->get();
        $joinAttendances = Attendance::where('user_id', Auth::id())
            ->pluck('party_id')    
            ->toArray();
        $attendeesCount = Attendance::whereNull('deleted_at')->count();


        return view('dashboard', [
            'activeParties' => $activeParties,
            'pastParties' => $pastParties,
            'partyCounts' => $partyCounts,
            'joinAttendances' => $joinAttendances,
            'attendeesCount' => $attendeesCount,
        ]);
    }


    public function viewPartyDetails($id)
    {
        $party = Party::find($id);
        $isFavorite = Favorite::where('user_id', Auth::id())
            ->where('party_id', $id)
            ->exists();
        $joinAttendances = Attendance::where('user_id', Auth::id())->pluck('party_id')->toArray();
        $attendeesCount = Attendance::whereNull('deleted_at')->count();
        return view('detailparty', compact('party', 'isFavorite', 'joinAttendances','attendeesCount'));
    }



    public function searchParty(Request $request)
    {
        // รับค่าจากฟอร์มค้นหา
        $query = $request->input('search');
        $province = $request->input('province');
        $type = $request->input('type');
        $sort = $request->input('sort');

        $parties = Party::query()
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('party_name', 'LIKE', '%' . $query . '%');
            })
            ->when($province, function ($queryBuilder) use ($province) {
                return $queryBuilder->where('province', $province);
            })
            ->when($type, function ($queryBuilder) use ($type) {
                return $queryBuilder->where('party_type_id', $type);
            })
            ->get();
        

        $activeParties = $parties;

        $partyTypeCounts = Party::select('party_type_id', DB::raw('count(*) as total'))
            ->groupBy('party_type_id')
            ->get()
            ->pluck('total', 'party_type_id'); 

        $joinAttendances = Attendance::where('user_id', Auth::id())->pluck('party_id')->toArray();

        return view('dashboard', [
            'parties' => $parties,
            'activeParties' => $activeParties,
            'partyTypeCounts' => $partyTypeCounts,
            'type' => $type ?? '', // ตรวจสอบว่ามีค่า type หรือไม่ ถ้าไม่มีก็ให้เป็นค่าว่าง
            'joinAttendances' => $joinAttendances
            
        ]);
    }
}
