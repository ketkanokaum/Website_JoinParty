<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
        public function showProfile()
        {
            $user = Auth::user();
            return view('profile_user',compact('user'));
        }
    }
    
    
