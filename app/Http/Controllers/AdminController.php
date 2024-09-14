<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Party;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
        }

    public function createParty()
    {
        $parties = Party::all();
        return view('admin.create', compact('parties'));
    }

    public function create(Request $request)
    {
        $newParty = new Party();
        $newParty->party_name = $request->party_name;
        $newParty->date = $request->date;
        $newParty->start_time = $request->start_time;
        $newParty->end_time = $request->end_time;
        $newParty->location = $request->location;
        $newParty->type_party = $request->type_party;
        $newParty->detail = $request->detail;
        $newParty->numpeople = $request->numpeople;
        $newParty->img = $request->img;
        $newParty->save();
        $parties = Party::all();
        return redirect('admin/create');
    }


    public function edit($id)
    {
        $party = Party::where('id', $id)->first();
        return view("admin.edit", compact('party'));
    }

    public function showUser(Request $request)
{
    $query = $request->input('query'); // รับค่าคำค้นหาจาก input

    if ($query) {
        // ค้นหาผู้ใช้ตาม fristname หรือ lastname
        $users = DB::table('users')
            ->where('fristname', 'LIKE', "%{$query}%")
            ->orWhere('lastname', 'LIKE', "%{$query}%")
            ->select('id', 'fristname', 'lastname', 'email', 'created_at')
            ->get();
    } else {
        // โหลดผู้ใช้ทั้งหมดเมื่อไม่มีการค้นหา
        $users = DB::table('users')
            ->select('id', 'fristname', 'lastname', 'email', 'created_at')
            ->limit(10)
            ->get();
    }

    // เช็คว่า request เป็นแบบ AJAX หรือไม่ และส่งผลลัพธ์เป็น JSON
    if ($request->ajax()) {
        return response()->json($users);
    }

    // ส่งผลลัพธ์ไปยัง view สำหรับแสดงผลครั้งแรก
    return view('admin.showUser', compact('users'));
}

}
