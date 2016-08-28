<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Courses;
use App\Models\Thread;
use App\Classes;
use App\User;
use App\Course_name;
use App\Categories;
use Auth;
use App\Comments;
use Carbon\Carbon;
use Redirect;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\CreateReplyRequest;


class ForumController extends Controller
{
    function __construct() {
    	$this->middleware('auth');
    } 

    public function getPost() {
    	
        $class_id = Auth::user()->class_id;
        $classes = Classes::where('id', '=', $class_id)->get();
     
        $cat = Auth::user()->category_id;
        $courses = [];

        $courses = Course_name::where('course_name.category_id', '=', $cat)->get();
        
        //$courses = Courses::all();
        //dd($courses);
        

    	return view('pages.forum', compact('courses'));
    }

    public function postQuestion(CreatePostRequest $request) 
    {
    	//dd($request['title']); //dump request

        $thread = new Thread();

        $thread->courses_id = $request['course'];
        // dd($request['course']);
        $thread->title = $request['title'];
        $thread->body = $request['body'];
        $user = Auth::getUser();
        $thread->name_id = $user['id'];
        $thread->timestamps = false;
        $thread->created_at = Carbon::now('GMT+7');

        $thread->save();
        //dd($thread);
        $data = Course_name::Select('name')
        ->where('id', '=', $request['course'])
        ->first();


        $path = '/forum/view/'.$data->name;
        return redirect()->intended($path);
    }

    public function viewQuestion($course) {
        $cat = Auth::user()->category_id;

        $threads = User::select('users.name', 'classes.class_name', 'threads.id', 'threads.title', 'course_name.name as course_name','threads.body', 'threads.slug', 'threads.created_at')
        ->join('classes', function($join){
            $join->on('classes.id', '=', 'users.class_id')
            ->where('classes.id','=', Auth::user()->class_id);
        }) 
        ->join('threads', 'threads.name_id', '=', 'users.id')
        ->join('course_name', 'course_name.id', '=', 'threads.courses_id')
        ->where('course_name.name','=', $course)
        ->where('course_name.category_id','=', $cat)
        ->orderBy('created_at', 'desc')
        ->get();

        $classes = User::select('classes.class_name')
        ->join('classes','users.class_id', '=', 'classes.id')
        ->where('users.email','=', Auth::user()->email)
        ->first();
            //dd($threads);
            // dd($classes);
        
        return view('pages.forum', compact('threads', 'classes'));     
    }

    public function showCourses() {

        $cat = Auth::user()->category_id;
        
        $threads = Course_name::where('course_name.category_id', '=', $cat)->get();

        return view('pages.forum', compact('threads'));
    }

    public function detailQuestion($course, $slug) {
        $threads = User::select('users.name', 'users.role', 'classes.class_name', 'threads.id', 'threads.title', 'threads.slug', 'course_name.name as course_name','threads.body', 'threads.created_at')
        ->join('classes', function($join){
            $join->on('classes.id', '=', 'users.class_id')
            ->where('classes.id','=', Auth::user()->class_id);
        }) 
        ->join('threads', 'threads.name_id', '=', 'users.id')
        ->join('course_name', 'course_name.id', '=', 'threads.courses_id')
        ->where('threads.slug', '=', $slug)
        ->orderBy('created_at', 'desc')
        ->get();

        $id = Thread::select('id')
        ->where('threads.slug', '=', $slug)
        ->first();

        $comments = Comments::select('comments.id as comment_id', 'comments.comments', 'users.id', 'users.name', 'users.role')
        ->join('threads','threads.id', '=', 'comments.thread_id')
        ->join('users', 'users.id','=', 'comments.user_id')
        ->where('comments.thread_id', '=', $id->id)
        ->get();

        return view('pages.forum',compact('threads', 'comments'));
    }

    public function postReply(Request $request, $course, $slug) {
        //dd($request['comments']);
        $comment = new Comments();

        $thread_id = Thread::select('id')
        ->where('threads.slug', '=', $slug)
        ->first();

        $comment->comments = $request['comments'];
        $comment->thread_id = $thread_id->id;
        $user = Auth::getUser()->id;
        $comment->user_id = $user;

        $comment->save();

        return redirect()->intended('forum/view/'.$course.'/detail/'.$slug);
        // return redirect()->intended('/');
    }

    public function deleteReply($course, $slug, $id) {

        Comments::destroy($id);
        

        return Redirect::to('forum/view/'.$course.'/detail/'.$slug)->with('success', true)->with('message','You have deleted your comment');
    }
}
