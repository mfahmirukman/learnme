<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function viewProfile() 
    {
        
        $users = User::select('users.id', 'users.name', 'users.class_id', 'classes.class_name', 'users.email', 'users.role')
            ->join('classes', function($join){
                $join->on('classes.id', '=', 'users.class_id')
                ->where('users.id', '=', Auth::user()->id);
            })
            ->get();

        return view('pages.profile', compact('users'));
    }

    public function editProfile() {
        $users = User::select('users.id', 'users.name', 'users.class_id', 'classes.class_name', 'users.email')
            ->join('classes', function($join){
                $join->on('classes.id', '=', 'users.class_id')
                ->where('users.id', '=', Auth::user()->id);
            })
            ->get();
        return view('pages.profile', compact('users'));
    }
}
