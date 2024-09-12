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

    public function showUser()
    {
        $users = DB::table('users')
            ->select('id', 'fristname', 'lastname', 'email', 'created_at') 
            ->get(); 
        return view("admin.showUser", compact('users'));
    }
}

