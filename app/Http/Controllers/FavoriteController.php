<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Attendance;
use App\Models\Party;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with(['party' => function ($query) {
            $query->whereNull('deleted_at');
        }])
            ->where('user_id', Auth::id())
            ->get();
        $joinAttendances = Attendance::where('user_id', Auth::id())->pluck('party_id')->toArray();
        $parties = Party::with('attendees')->get();
        return view('favorite', compact('favorites', 'joinAttendances', 'parties'));
    }



    public function addToFavorite(Request $request)
    {
        $userId = Auth::id();
        $existingFavorite = Favorite::withTrashed()
            ->where('user_id', $userId)
            ->where('party_id', $request->party_id)
            ->first();

        if (!$existingFavorite) {
            $favorite = new Favorite();
            $favorite->user_id = $userId;
            $favorite->party_id = $request->party_id;
            $favorite->save();
        } else {
            $existingFavorite->restore();
        }

        return redirect()->back();
    }


    public function removeFavorite($id)
    {
        $favorite = Favorite::where('user_id', Auth::id())->where('party_id', $id)->first();
        if ($favorite) {
            $favorite->delete(); // ลบรายการโปรดออกจากฐานข้อมูล
            return redirect()->route('favorites')->with('success', 'ลบรายการโปรดเรียบร้อยแล้ว');
        }

        return redirect()->route('favorites')->with('error', 'ไม่พบปาร์ตี้ในรายการโปรด');
    }
}
