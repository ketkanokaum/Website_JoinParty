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
        $time = date('Y-m-d H:i:s');

        $activeParties = Party::select('parties.*')
        ->leftJoin('attendances', 'parties.id', '=', 'attendances.party_id')
        ->selectRaw('COUNT(CASE WHEN attendances.status = "joined" THEN 1 END) as joined_count')
        ->where('start_date', '>', $time)
        ->groupBy(
            'parties.id',
            'parties.party_name',
            'parties.start_date',
            'parties.end_date',
            'parties.start_time',
            'parties.end_time',
            'parties.location',
            'parties.detail',
            'parties.province',
            'parties.numpeople',
            'parties.img',
            'parties.party_type_id',
            'parties.contact',
            'parties.img_contact',
            'parties.created_at',
            'parties.updated_at',
            'parties.deleted_at'
        )
        ->orderBy('start_date', 'asc')
        ->get();


        // ดึงข้อมูลปาร์ตี้ที่ผ่านไปแล้ว พร้อมนับจำนวนผู้เข้าร่วมที่มีสถานะ 'joined'
        $pastParties = Party::select('parties.*')
            ->leftJoin('attendances', 'parties.id', '=', 'attendances.party_id')
            ->selectRaw('COUNT(CASE WHEN attendances.status = "joined" THEN 1 END) as joined_count')
            ->where('start_date', '<=', $time)
            ->groupBy(
                'parties.id',
                'parties.party_name',
                'parties.start_date',
                'parties.end_date',
                'parties.start_time',
                'parties.end_time',
                'parties.location',
                'parties.detail',
                'parties.province',
                'parties.numpeople',
                'parties.img',
                'parties.party_type_id',
                'parties.contact',
                'parties.img_contact',
                'parties.created_at',
                'parties.updated_at',
                'parties.deleted_at'
            ) 
            ->get();


        $partyCounts = Party::select('party_type_id', DB::raw('count(*) as total'))
            ->groupBy('party_type_id')
            ->get();
        $joinAttendances = Attendance::where('user_id', Auth::id())
            ->pluck('party_id')
            ->toArray();



        return view('dashboard', [

            'activeParties' => $activeParties,
            'pastParties' => $pastParties,
            'partyCounts' => $partyCounts,
            'joinAttendances' => $joinAttendances,

        ]);
    }


    public function viewPartyDetails($id)
    {
        $party = Party::select('parties.*')
        ->leftJoin('attendances', 'parties.id', '=', 'attendances.party_id')
        ->selectRaw('COUNT(CASE WHEN attendances.status = "joined" THEN 1 END) as joined_count')
        ->where('parties.id', $id)
        ->groupBy(
            'parties.id',
            'parties.party_name',
            'parties.start_date',
            'parties.end_date',
            'parties.start_time',
            'parties.end_time',
            'parties.location',
            'parties.detail',
            'parties.province',
            'parties.numpeople',
            'parties.img',
            'parties.party_type_id',
            'parties.contact',
            'parties.img_contact',
            'parties.created_at',
            'parties.updated_at',
            'parties.deleted_at'
        )
        ->first(); 
        $isFavorite = Favorite::where('user_id', Auth::id())
            ->where('party_id', $id)
            ->exists();
        $joinAttendances = Attendance::where('user_id', Auth::id())->pluck('party_id')->toArray();
        return view('detailparty', compact('party', 'isFavorite', 'joinAttendances'));
    }



    public function searchParty(Request $request)
    {
        // รับค่าจากฟอร์มค้นหา
        $query = $request->input('search');
        $province = $request->input('province');
        $type = $request->input('type');
        $sort = $request->input('sort');

        $parties = Party::query()
        ->leftJoin('attendances', 'parties.id', '=', 'attendances.party_id') // JOIN กับตาราง attendances
        ->select('parties.*') 
        ->selectRaw('COUNT(CASE WHEN attendances.status = "joined" THEN 1 END) as joined_count') // นับจำนวนผู้เข้าร่วมที่มีสถานะ 'joined'
        ->when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('party_name', 'LIKE', '%' . $query . '%');
        })
        ->when($province, function ($queryBuilder) use ($province) {
            return $queryBuilder->where('province', $province);
        })
        ->when($type, function ($queryBuilder) use ($type) {
            return $queryBuilder->where('party_type_id', $type);
        })
        ->groupBy(
            'parties.id',
            'parties.party_name',
            'parties.start_date',
            'parties.end_date',
            'parties.start_time',
            'parties.end_time',
            'parties.location',
            'parties.detail',
            'parties.province',
            'parties.numpeople',
            'parties.img',
            'parties.party_type_id',
            'parties.contact',
            'parties.img_contact',
            'parties.created_at',
            'parties.updated_at',
            'parties.deleted_at'
        ) // รวมฟิลด์ทั้งหมดใน GROUP BY
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
