<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function login() {
    	return view('backend.admin');
    }

    public function assignment() {
    	return view('pages.assignment');

    }
}
