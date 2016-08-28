<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use Auth;
use App\Course_name;
use App\Classes;
use App\Assignment;
use App\Submission;
use App\User;
use App\Assignment_Grouping;
use Carbon\Carbon;

use App\Http\Requests\CreateAssignmentRequest;
use App\Http\Requests\CreateSubmissionRequest;

class AssignmentController extends Controller
{   

     public function getAssignment() {
        
        $class_id = Auth::user()->class_id;
        $classes = Classes::where('id', '=', $class_id)->get();
     
        $cat = Auth::user()->category_id;

        $classes = Classes::select('classes.id', 'class_name')
        ->join('teacher_groupings', 'class_id', '=', 'classes.id')
        ->where('teacher_groupings.user_id', '=', Auth::user()->id)
        ->get();
        // $time = Carbon::now('GMT+7');
        // dd($time);

        return view('pages.assignment', compact('classes'));
    }

    public function postAssignment(CreateAssignmentRequest $request) 
    {
        //dd($request['title']); //dump request

        $assignment = new Assignment();

        $assignment->course_id = Auth::user()->course_id;
        $assignment->creator_id = Auth::user()->id;
        $assignment->for_class_id = $request['class'];
        $assignment->title = $request['title'];
        $assignment->link = $request['link'];
        $assignment->timestamps = false;
        $assignment->created_at = Carbon::now('GMT+7');    
        $assignment->due_at = $request['duedate'];    
        // dd($request['duedate']);
        $assignment->save();

        return redirect()->intended('/');
    }


    public function showCourses() {

        if(str_contains(Auth::user()->role, 'teacher')) {
            $cat = Auth::user()->course_id;
        
            $courses = Course_name::where('course_name.id', '=', $cat)->get();
            return view('pages.assignment', compact('courses'));

        } else if(str_contains(Auth::user()->role, 'student')) {
            $cat = Auth::user()->category_id;
        
            $courses = Course_name::where('course_name.category_id', '=', $cat)->get();
            return view('pages.assignment', compact('courses'));
        }
    }

    public function viewAssignment($course){
       
        if(str_contains(Auth::user()->role, 'teacher')) {
            $assignments = User::select('users.name as creator_name', 'classes.class_name',  'course_name.name as course_name', 'assignments.id', 'assignments.title','classes.class_name' , 'assignments.created_at', 'assignments.due_at')
            ->join('assignments', 'assignments.creator_id', '=', 'users.id')
            ->join('classes', 'classes.id', '=', 'assignments.for_class_id')
            ->join('course_name', 'course_name.id', '=', 'assignments.course_id')
            ->where('course_name.name','=', $course)
            ->orderBy('created_at', 'desc')
            ->get();

        //dd($assignments);

        return view('pages.assignment', compact('assignments'));

        } else if(str_contains(Auth::user()->role, 'student')) {
            $assignments = User::select('users.name as creator_name', 'classes.class_name',  'course_name.name as course_name', 'assignments.id', 'assignments.title','classes.class_name' , 'assignments.created_at', 'assignments.due_at')
            ->join('assignments', 'assignments.creator_id', '=', 'users.id')
            ->join('classes', 'classes.id', '=', 'assignments.for_class_id')
            ->join('course_name', 'course_name.id', '=', 'assignments.course_id')
            ->where('course_name.name','=', $course)
            ->where('assignments.for_class_id', '=', Auth::User()->class_id)
            ->orderBy('created_at', 'desc')
            ->get();

            return view('pages.assignment', compact('assignments'));
        }

        

    }

    public function detailAssignment($course, $id) {

        if(str_contains(Auth::user()->role, 'teacher')) {
            $cat = Auth::user()->course_id;

            $assignments = Assignment::select('assignments.id', 'assignments.title')
            ->where('assignments.id','=', $id)
            ->get();


            $details = Assignment::select('assignments.id', 'assignments.link', 'assignments.title', 'classes.class_name')
            ->join('classes', 'classes.id', '=', 'assignments.for_class_id')
            ->where('assignments.id','=', $id)
            ->get();

            $getclass = Assignment::select('for_class_id')
            ->where('id', '=', $id)
            ->first();

            $class = $getclass->for_class_id;
            // dd($class);

            $studentlists = User::select('users.id', 'users.name')
            ->where('class_id', '=', $class)
            ->where('role','=', 'student')
            ->get();


        	return view('pages.assignment', compact('assignments', 'details', 'studentlists', 'id'));
        } else if(str_contains(Auth::user()->role, 'student')) {
            $cat = Auth::user()->course_id;

            $assignments = Assignment::select('assignments.id', 'assignments.title')
            ->where('assignments.id','=', $id)
            ->get();

            $details = Assignment::select('assignments.id', 'assignments.link', 'assignments.title', 'classes.class_name', 'assignments.due_at')
            ->join('classes', 'classes.id', '=', 'assignments.for_class_id')
            ->where('assignments.id','=', $id)
            ->get();

            $submission = Submission::select('submissions.user_id','submissions.link')
            ->where('submissions.user_id', '=', Auth::user()->id)
            ->where('submissions.assignment_id','=',$id)
            ->first();

            // dd($submission);

            $flag = true;
            if($submission == null ) {
                $flag = true;
            }
            else {
                $flag = false;
            }
            // dd($flag);
            //if true then submission's link is accessible by view otherwise
            //if false then the flag determines the submission table's appearance

            return view('pages.assignment', compact('assignments', 'details', 'course', 'submission', 'flag'));


        }
    }

    

    public function submitAssignment(CreateSubmissionRequest $request){
        $submission = new Submission();
        $course = $request['course_name'];
        $submission->assignment_id = $request['ass_id'];
        $submission->user_id = $request['user_id'];
        $submission->link = $request['link'];
        // $submission->timestamp = false;

        $submission->save();
        
        $path = '/assignment/view/'.$course.'/detail/'.$request['ass_id'].'/post';
    	return redirect()->intended($path);
    }
}
