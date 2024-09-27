<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with('party')->where('user_id', Auth::id())->get();
        foreach ($favorites as $favorite) {
            $favorite->isFavorite = true; // เนื่องจากนี่คือหน้ารายการโปรด ทุก party จะมี isFavorite เป็น true
        }

        return view('favorite', compact('favorites'));
    }

    
    public function addToFavorite(Request $request) {
        $userId = Auth::id(); 
    
        // ตรวจสอบว่าผู้ใช้คนนี้มี party นี้ในรายการโปรดแล้วหรือไม่ (รวมถึงรายการที่ถูกลบชั่วคราว)
        $existingFavorite = Favorite::withTrashed()
            ->where('user_id', $userId)
            ->where('party_id', $request->party_id)
            ->first();
    
        $favorite = new Favorite();
        $favorite->user_id = $userId; // ใช้ user_id ที่ดึงมาจาก Auth::id()
        $favorite->party_id = $request->party_id; // เก็บ id ของปาร์ตี้จาก request
        $favorite->save();
    
        return redirect()->route('party.details', ['id' => $request->party_id]);
    }
    


    public function removeFavorite($id) {

        $favorite = Favorite::where('user_id', Auth::id())->where('party_id', $id)->first();
        if ($favorite) {
            $favorite->delete();
            return redirect()->route('party.details', ['id' => $id]);
    }

    return redirect()->back()->with('error', 'ไม่พบปาร์ตี้ในรายการโปรด');

}
}
        


