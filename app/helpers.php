<?php 

use App\Http\Requests;
use App\Models\Courses;
use App\Models\Thread;
use App\Classes;
use App\User;
use App\Course_name;
use App\Categories;
use App\Comments;
use Carbon\Carbon;


function deleteComment($id) {
		$comment = Comments::find($id);
		$thread = Thread::select()
		->join('course_name', 'course_name.id', '=', 'threads.courses_id')
		->where('threads.id', '=', $comment->thread_id)
		->first();

		$comment->delete();

		return redirect()->intended('forum/view/'.$thread->name.'/detail/'.$thread->slug);

}