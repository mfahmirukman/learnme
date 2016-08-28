<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Classes;
use App\Models\Courses;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function showcourse() {
    //     $courses = Courses::all();
    //     return view('layouts.app', compact('courses'));
    // }

    public function home() {
        return view('welcome');
    }

}
