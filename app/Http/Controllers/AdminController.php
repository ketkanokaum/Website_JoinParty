<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Party;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
        }
        


    public function createParty()
    {
        $parties = Party::all();
        return view('admin/create', compact('parties'));
    }

    public function insert(Request $request)
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

    public function showEditPage()
    {
        $parties = Party::all(); // ดึงรายการปาร์ตี้ทั้งหมดจากฐานข้อมูล
        return view('admin.edit', compact('parties'));
    }
    

    public function update(Request $request, $id){

    $party = Party::find($id);
    if ($request->has('party_name')) {
        $party->party_name = $request->party_name;
    }
    if ($request->has('date')) {
        $party->date = $request->date;
    }
    if ($request->has('start_time')) {
        $party->start_time = $request->start_time;
    }
    if ($request->has('end_time')) {
        $party->end_time = $request->end_time;
    }
    if ($request->has('location')) {
        $party->location = $request->location;
    }
    if ($request->has('type_party')) {
        $party->type_party = $request->type_party;
    }
    if ($request->has('detail')) {
        $party->detail = $request->detail;
}
    if ($request->has('numpeople')) {
        $party->numpeople = $request->numpeople;
    }
    if ($request->hasFile('img')) {
        $image = $request->file('img');
        $imagePath = $image->store('public/party_images');
        $party->img = basename($imagePath); // เก็บชื่อไฟล์ภาพ
    }
    $party->save();
    return redirect('admin/edit');
}


    public function showUser(Request $request){
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
