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
use App\Models\Attendance;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function createParty()
    {
        $time = date('Y-m-d H:i:s');


        $parties = Party::select('parties.*')
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
            ->paginate(6);

        $partyTypes = PartyType::all();


        return view('admin/create', compact('parties', 'partyTypes'));
    }

    public function searchparty(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort');

        $partyTypes = PartyType::all();

        $parties = Party::query();


        if ($query) {
            $parties->where('party_name', 'like', "%$query%");
        }

        if ($sort == 'asc') {
            $parties->orderBy('start_date', 'asc');
        } else {
            $parties->orderBy('start_date', 'desc');
        }
        $parties = $parties->paginate(6);

        if ($parties->total() == 0) {
            $message = "ไม่พบกิจกรรม";
        } else {
            $message = null;
        }

        return view('admin/create', compact('parties', 'partyTypes'));
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
        $newParty->contact = $request->contact;

        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('party_images'), $imageName);
            $newParty->img = $imageName;
        }

        if ($request->hasFile('img_contact')) {
            $imageName = time() . '.' . $request->img_contact->extension();
            $request->img_contact->move(public_path('contact_images'), $imageName);
            $newParty->img_contact = $imageName;
        }

        $newParty->save();
        $parties = Party::all();
        return redirect('admin/create');
    }


    public function showEditPage()
    {
        $parties = Party::all();
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
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('party_images'), $imageName);
            $party->img = $imageName;
        }
        if ($request->hasFile('img_contact')) {
            $imageName = time() . '.' . $request->img_contact->extension();
            $request->img_contact->move(public_path('contact_images'), $imageName);
            $party->img_contact = $imageName;
        }

        $party->save();
        return redirect('admin/create');
    }

    public function delete($id)
    {
        $party = Party::find($id);
        if ($party) {
            $party->delete();
            return redirect('admin/create');
        }
    }

    public function showReview()
    {
        $reviews = Review::with(['party', 'attendance.user'])->whereHas('party')->get();

        $parties = $reviews->groupBy('party_id');
        $avg_ratings = Review::select('party_id', DB::raw('avg(rating) as average_rating'))
            ->groupBy('party_id')
            ->get()
            ->keyBy('party_id');

        return view('admin/review', compact('reviews', 'parties', 'avg_ratings'));
    }

    public function store(Request $request)
    {
        // ตรวจสอบว่าการเข้าร่วม 
        $attendance = Attendance::where('user_id', $request->user_id)
            ->where('party_id', $request->party_id)
            ->first();


        if (!$attendance) {
            $attendance = Attendance::create([
                'user_id' => $request->user_id,
                'party_id' => $request->party_id,
                'joined_at' => now(),
            ]);
        }
        $existingReview = Review::where('attendance_id', $attendance->id)
            ->where('party_id', $request->party_id)
            ->first();

        if ($existingReview) {
            return redirect()->back();
        }

        if ($attendance && $attendance->id) {
            $reviews = new Review();
            $reviews->attendance_id = $attendance->id;
            $reviews->party_id = $request->party_id;
            $reviews->review = $request->review;
            $reviews->rating = $request->rating;
            $reviews->save();
        }
        return redirect('/myparty');
    }


    public function showUser(Request $request)
    {
        $users = User::paginate(10);
        $usersde = User::whereNull('deleted_at')->get();
        $deletedUsers = User::onlyTrashed()->get();
        return view('admin.showUser', compact('users', 'usersde', 'deletedUsers'));
    }



    public function searchUser(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('fristname', 'LIKE', "%{$query}%")
            ->orWhere('lastname', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->paginate(10);

        if ($users->isEmpty()) {
            $message = "ไม่พบบัญชีผู้ใช้";
        } else {
            $message = null;
        }
        $deletedUsers = User::onlyTrashed()->get();
        return view('admin.showUser', compact('users', 'deletedUsers', 'message'));
    }

    public function deleteUser($id)
    {
        $users = User::find($id);
        if ($users) {
            $users->delete();
            return redirect('admin/showUser');
        }
    }

    public function restoreUser($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
            return redirect()->back();
        }
        return redirect()->back();
    }


    public function showDeletedUsers()
    {
        $deletedUsers = User::onlyTrashed()->get();

        return view('admin.showUser', ['deletedUsers' => $deletedUsers, 'users' => collect([])]);
    }
}
