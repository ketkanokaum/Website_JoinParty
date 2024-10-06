<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PartyType;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    function index(){
        $user = Auth::user()->usertype;
        if($user=="user" ){
            return redirect()->route('party.show');
        }
        else if($user=="admin"){
            return view("admin/dashboard");
        }
        else{
            return redirect('error');
        }
    }


}
