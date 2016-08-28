<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Courses;
use Auth;
use App\Course_Name;
use App\Materials;
use App\Classes;
use App\User;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCourses() {
    	$class_id = Auth::user()->class_id;
        $class = Classes::select('classes.class_name')
        ->join('users', 'users.class_id', '=', 'classes.id')
        ->where('classes.id', '=', $class_id)
        ->first();

        $cat = Auth::user()->category_id;
        $class_num = $class->class_name;

        if(str_contains($class_num,'12')) {
            $class_num = '12';
        } else if(str_contains($class_num,'11')) {
            $class_num = '11';
        } else if(str_contains($class_num,'10')) {
            $class_num = '10';
        }

        $user = User::select('users.id', 'classes.class_name')
        ->join('classes', 'classes.id', '=', 'users.class_id')
        ->where('users.id','=', Auth::user()->id)
        ->first();



        $materials = Materials::select('materials.id', 'materials.chapter', 'materials.r_link', 'materials.s_link', 'course_name.name')
        ->join('course_name', 'course_name.id', '=', 'materials.course_id')
        // ->join('users', 'users.course_id', '=','materials.course_id') //for teacher
        ->where('materials.class_num','=', $class_num)
        ->where('materials.category_id','=', $cat)
        ->get();
        // dd($materials);
    	return view('pages.courses', compact('materials', 'user'));
    }


    public function viewReading($course, $chapter) {
        $class_id = Auth::user()->class_id;
        $class = Classes::select('classes.class_name')
        ->join('users', 'users.class_id', '=', 'classes.id')
        ->where('classes.id', '=', $class_id)
        ->first();

        $cat = Auth::user()->category_id;
        $class_num = $class->class_name;

        if(str_contains($class_num,'12')) {
            $class_num = '12';
        } else if(str_contains($class_num,'11')) {
            $class_num = '11';
        } else if(str_contains($class_num,'10')) {
            $class_num = '10';
        }


        $materials = Materials::select('materials.id', 'materials.course_id', 'materials.chapter', 'materials.description', 'materials.r_link', 'course_name.name')
        ->join('course_name', 'course_name.id', '=', 'materials.course_id')
        ->where('course_name.name','=', $course)
        ->where('materials.class_num','=', $class_num)
        ->where('materials.category_id','=', $cat)
        ->where('materials.id', '=', $chapter)
        ->get();


        return view('pages.reading', compact('materials', 'course'));
    }

    public function supportingCourses($course, $chapter) {
        $class_id = Auth::user()->class_id;
        $class = Classes::select('classes.class_name')
        ->join('users', 'users.class_id', '=', 'classes.id')
        ->where('classes.id', '=', $class_id)
        ->first();

        $cat = Auth::user()->category_id;
        $class_num = $class->class_name;

        if(str_contains($class_num,'12')) {
            $class_num = '12';
        } else if(str_contains($class_num,'11')) {
            $class_num = '11';
        } else if(str_contains($class_num,'10')) {
            $class_num = '10';
        }


        $materials = Materials::select('materials.id', 'materials.course_id', 'materials.chapter', 'materials.description', 'materials.s_link', 'course_name.name')
        ->join('course_name', 'course_name.id', '=', 'materials.course_id')
        ->where('course_name.name','=', $course)
        ->where('materials.class_num','=', $class_num)
        ->where('materials.category_id','=', $cat)
        ->where('materials.id', '=', $chapter)
        ->get();


        return view('pages.support', compact('materials', 'course'));
    }

    public function test() {
        return view('welcome');

    }

}
