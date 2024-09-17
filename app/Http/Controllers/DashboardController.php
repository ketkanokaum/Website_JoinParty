<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    function index(){
        $user = Auth::user()->usertype;
        if($user=="user" ){
            return view("/dashboard");
        }
        else if($user=="admin"){
            return view("admin/dashboard");
        }
        else{
            return redirect('error');
        }
    }
}
