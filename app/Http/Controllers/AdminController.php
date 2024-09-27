<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Party;
use App\Models\Review;
use App\Models\PartyType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
        }



    public function createParty()
    {
        $parties = Party::all();
        $partyTypes = PartyType::all();
        return view('admin/create', compact('parties','partyTypes'));
    }

    public function insert(Request $request)
    {
        $newParty = new Party();
        $newParty->party_name = $request->party_name;
        $newParty->start_date = $request->start_date;
        $newParty->end_date = $request->end_date;
        $newParty->start_time = $request->start_time;
        $newParty->end_time = $request->end_time;
        $newParty->location = $request->location;
        $newParty->province = $request->province;
        $newParty->party_type_id = $request->party_type_id;
        $newParty->detail = $request->detail;
        $newParty->numpeople = $request->numpeople;
        $newParty->contact = $request->contact; // ตั้งค่าการติดต่อ
    
        // อัปโหลดไฟล์ img
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('party_images'), $imageName);
            $newParty->img = $imageName; // ตั้งค่า img
        }
    
        // อัปโหลดไฟล์ img_contact
        if ($request->hasFile('img_contact')) {
            $imageName = time() . '.' . $request->img_contact->extension();
            $request->img_contact->move(public_path('contact_images'), $imageName);
            $newParty->img_contact = $imageName; // ตั้งค่า img_contact
        }
    
        $newParty->save();
        $parties = Party::all();
        return redirect('admin/create');
    }
    

    public function showEditPage()
    {
        $parties = Party::all(); // ดึงรายการปาร์ตี้ทั้งหมดจากฐานข้อมูล
        return view('admin/create', compact('parties'));
    }


    public function update(Request $request, $id)
    {
    
        $party = Party::find($id);
    if ($request->has('party_name')) {
        $party->party_name = $request->party_name;
    }
    if ($request->has('start_date')) {
        $party->start_date = $request->start_date;
    }
    if ($request->has('end_date')) {
        $party->end_date = $request->end_date;
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
    if ($request->has('province')) {
        $party->province = $request->province;
    }
    $partyTypes = PartyType::all();

    if ($request->has('detail')) {
        $party->detail = $request->detail;
}
    if ($request->has('numpeople')) {
        $party->numpeople = $request->numpeople;
    }
    if ($request->has('contact')) {
        $party->contact = $request->contact;
    }
        // อัปโหลดไฟล์ img
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('party_images'), $imageName);
            $party->img = $imageName; // ตั้งค่า img
        }
    
        // อัปโหลดไฟล์ img_contact
        if ($request->hasFile('img_contact')) {
            $imageName = time() . '.' . $request->img_contact->extension();
            $request->img_contact->move(public_path('contact_images'), $imageName);
            $party->img_contact = $imageName; // ตั้งค่า img_contact
        }
    
        $party->save();
        return redirect('admin/create');
    }
    
public function delete($id){
    $party= Party::find($id);
    if($party){
        $party->delete();
        return redirect('admin/create');
    }
}  

    public function showReview(){

        $reviews = Review::with(['party', 'user'])->get();
        return view('admin/review', compact('reviews'));
    }

    public function store(Request $request){
        $reviews = new Review();
        $reviews->user_id = $request->user_id;
        $reviews->party_id = $request->party_id;
        $reviews->review = $request->review;
        $reviews->rating = $request->rating;
        $reviews->save();
        $reviews = Review::all();
        return redirect('myparty');
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
