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
        return view('myparty', compact('favorites'));
    }

    public function addToFavorite(Request $request){

        $existingFavorite = Favorite::where('user_id', $request->user_id)
        ->where('party_id', $request->party_id)
        ->first();

        if (!$existingFavorite) {
            $favorite = new Favorite();
            $favorite->user_id = $request->user_id; // เก็บ id ของผู้ใช้
            $favorite->party_id = $request->party_id;  // เก็บ id ของปาร์ตี้
            $favorite->save();
        }
            return redirect('party.details',['id' => $request->party_id])->with('success', 'เพิ่มไปยังรายการโปรดแล้ว');
        }

        public function removeFavorite($id){
            $userId = Auth::id();

            dd($userId, $id);

            Favorite::where('user_id', $userId )
                ->where('party_id', $id)
                ->delete();
                return redirect()->route('party.details', ['id' => $id])->with('success', 'ลบจากรายการโปรดแล้ว');

            }
            }
        


