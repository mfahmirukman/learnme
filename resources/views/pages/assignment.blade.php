@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Assignment</div>
                <div class="panel-body">
                @if(str_contains(Auth::user()->role, 'teacher'))

                    @if(str_contains($url = Request::url(),'post'))

                        @include('layouts.partials.form_error')

                    	{!! Form::open(['id'=>'post-assignment']) !!}

                        {!! Form::label('title', 'Title')!!}
                        {!! Form::text('title', null, ['id' => 'title', 'class' =>'form-control', 'placeholder' => 'Your Title', 'required'])!!}
                        <br/>

                        {!! Form::label('class', 'Class')!!}
     
                        <br/>
                        <select name="class" class='form-control'>
                            @foreach($classes as $class)
                                <option value ="{{ $class->id}}">{{ $class->class_name}}</option>
                            @endforeach
                        </select>
                        <br/>

                        {!! Form::label('link', 'Link')!!}
                        {!! Form::textarea('link', null, ['id' => 'link', 'class' =>'form-control', 'placeholder' => 'Post your uploaded file link here', 'required'])!!}
                        <br/>
                        
                        {!! Form::label('duedate', 'Due Date from ')!!}
                        <br/>
                        <select name="duedate" class='form-control'>
                            @for ($i = 1; $i < 31; $i++)
                                {{-- */ $time = \Carbon\Carbon::now('GMT+7')/* --}}
                                <option value ="{{$time->addDays($i)}}">{{\Carbon\Carbon::now()->addDays($i)->toFormattedDateString()}}</option>
                                }
                            @endfor
                        </select>
                        <br/>


                        {!! Form::button('Post Assignment', ['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit'])!!}
                        {!! Form::close()!!}

                    @elseif(str_contains($url = Request::url(),'show'))

                        <div class="panel-heading">View Categories</div>
                        <div class="panel-body">
                        <br>

                        @forelse($courses as $course)                
                        <a href={{'view/'.$course->name}}><div class="well">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="media-heading" style="text-align:center">{{$course->name}}</h3>
                                </div>
                            </div>
                        </div>
                        </a>

                        @empty
                            <p>No Post found</p>
                        @endforelse

                    @elseif(str_contains($url = Request::url(),'detail'))
                        
                                <div class="panel-body">
                                <br>

                                @forelse($assignments as $assignment)                              
                                <div class="well">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="media-heading" style="text-align:center">{{$assignment->title}}</h3>

                                            <table class="table table-bordered">
                                            {{-- */$count=1;/* --}}
                                            @forelse($details as $detail)
                                                <tbody>
                                                    <tr>
                                                        <td>Title</td>
                                                        <td>For Class</td>
                                                        <td>Download</td>
                                                    </tr>
                                                </tbody>

                                                <tbody>
                                                    <tr>
                                                    <td>{{$detail->title}}</td>
                                                    <td>{{$detail->class_name}}</td>
                                                    <td><a href="{{$detail->link}}"><span class="glyphicon glyphicon-download"></span></a></td>
                                                    

                                                    </tr>
                                                </tbody>
                                                {{--*/$count++/*--}}
                                            @empty
                                                <p>No questions found regarding this assignment</p>
                                            @endforelse
                                            </table>

                                            <!-- for submission views -->
                                            <table class="table table-bordered">
                                            
                                            <tbody>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Name</td>
                                                        <td>Download</td>
                                                    </tr>
                                            </tbody>
                                            {{-- */$count=1;/* --}}
                                            @forelse($studentlists as $studentlist)
                                                
                                                
                                                <tbody>
                                                    <tr>
                                                    <td> {{$count}}</td>

                                                    {{--*/$asgmt = \App\Submission::select('submissions.link')->where('submissions.user_id','=', $studentlist->id)->where('submissions.assignment_id','=', $detail->id)->first()/*--}}

                                                    <td>{{$studentlist->name}}</td>


                                                    @if($asgmt == null)
                                                        <td>Hasn't uploaded assignment</td>
                                                    @else
                                                        <td><a href="{{$asgmt->link}}"><span class="glyphicon glyphicon-download"></span></a></td>
                                                    @endif
                                                    </tr>
                                                </tbody>
                                                {{--*/$count++/*--}}
                                            @empty
                                                <p>No questions found regarding this assignment</p>
                                            @endforelse
                                            </table>
                                    </div>
                                </div>  
                                @empty
                                    <p>No assignments found</p>
                                @endforelse

                    @elseif(str_contains($url = Request::url(),'view'))

                        <div class="panel-heading">View Assignment</div>
                            <div class="panel-body">
                            
                                
                                <br>

                                @forelse($assignments as $assignment)
                                         
                                <div class="well">
                                    <div class="media">
                                        <div class="media-body">

                                            <a href={{$assignment->course_name.'/detail/'.$assignment->id}}><h3 class="media-heading">{{$assignment->title}}</h3></a>
                                            <p><h4 class="media-heading">{{$assignment->class_name}}</h4></p>
                                            <p class="text-right">By : {{$assignment->creator_name}}</p>
                                            <p class="text-right">Date Created: {{$assignment->created_at}}</p>  
                                            <p class="text-right">Due Date: {{$assignment->due_at}}</p>  
                                                                      
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <p>No Post found</p>
                                @endforelse
                    @endif

                @elseif(str_contains(Auth::user()->role, 'student'))

                    @if(str_contains($url = Request::url(),'detail'))

                                <div class="panel-body">
                                <br>

                                @forelse($assignments as $assignment)                              
                                <div class="well">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="media-heading" style="text-align:center">{{$assignment->title}}</h3>
                                            <br/>

                                            <table class="table table-bordered">
                                            {{-- */$count=1;/* --}}
                                            @forelse($details as $detail)
                                                <tbody>
                                                    <tr>
                                                        
                                                    </tr>
                                                </tbody>

                                                <tbody>
                                                    <tr>
                                                        @if(str_contains($detail->link, 'docs'))
                                                            {{-- */ $source = $detail->link."?embedded=true" /* --}}
                                                            <td><iframe src="{{$source}}" height="500" width="100%"></iframe></td>
                                                        @else
                                                            <td><h3 class="media-heading" style="text-align:center">Document is empty</h3></td>
                                                        @endif
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                        @if(str_contains($detail->link, 'docs'))
                                                            {{-- */ $source2 = $detail->link /* --}}
                                                            <a href="{{$source2}}"><button  class="btn btn-lg btn-primary btn-block">Download</button></a>
                                                        @else
                                                            <p class="media-heading" style="text-align:center">Document is empty</p>
                                                        @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <br/>
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    {{-- */ $now = \Carbon\Carbon::now('GMT+7')/* --}}
                                                    {{-- */ $nowdate = $now->toFormattedDateString()/*--}}
                                                    <td>Current Time : {{$nowdate}}</td>
                                                </tr>
                                                <tr>
                                                    {{--*/$due = new \Carbon\Carbon($detail->due_at)/*--}}
                                                    {{--*/$duedate = $due->toFormattedDateString()/*--}}

                                                    <td>Assignment Due Date : {{$duedate}}</td>
                                                </tr>
                                                    <tr>
                                                        @if($flag)
                                                        <td>Submit your assignment
                                                         @include('layouts.partials.form_error')

                                                            {!! Form::open(['id'=>'submit-assignment']) !!}
                                                                {!! Form::label('link', 'Link')!!}
                                                                {!! Form::text('link', null, ['id' => 'link', 'class' =>'form-control', 'placeholder' => 'Your link here', 'required'])!!}

                                                                {!! Form::hidden('course_name', $course)!!}
                                                                {!! Form::hidden('ass_id', $detail->id)!!}
                                                                {!! Form::hidden('user_id', Auth::User()->id)!!}
                                                                <br/>
                                                                
                                                                @if($due->diffInDays($now) > 0)
                                                                    {!! Form::button('Post Your Assignment', ['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit'])!!}

                                                                @elseif($due->diffInDays($now) <= 0)
                                                                    {!! Form::button('Post Your Assignment', ['disabled', 'class' => 'btn btn-lg btn-danger btn-block', 'type' => 'submit'])!!}
                                                                @endif

                                                            {!! Form::close()!!}

                                                        @else
                                                            <td>You have submitted your assignment.</td>
                                                            <br/>
                                                            <tr><td>Here's a preview of your assignment</td></tr>
                                                            <br/>
                                                            <tr>
                                                                {{-- */ $submitted = $submission->link."?embedded=true" /* --}}
                                                            <td><iframe src="{{$submitted}}" height="500" width="100%"></iframe></td>
                                                            </tr>
                                                        @endif
                                                        </td>
                                                    </tr>                                                    
                                                </tbody>

                                            </table>
                                                {{--*/$count++/*--}}
                                            @empty
                                                <p>No questions found regarding this assignment</p>
                                            @endforelse
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                            
                                        
                                    </div>
                                </div>  
                                @empty
                                    <p>No assignments found</p>
                                @endforelse
                @elseif(str_contains($url = Request::url(),'show'))

                    <div class="panel-heading">Courses</div>
                    <div class="panel-body">
                    <br>

                    @forelse($courses as $course)                
                    <a href={{'view/'.$course->name}}><div class="well">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="media-heading" style="text-align:center">{{$course->name}}</h3>
                            </div>
                        </div>
                    </div>
                    </a>

                    @empty
                        <p>No Post found</p>
                    @endforelse

                @elseif(str_contains($url = Request::url(),'view'))
                    <div class="panel-heading">View Assignment</div>
                        <div class="panel-body">
                        
                            
                            <br>

                            @forelse($assignments as $assignment)
                                     
                            <div class="well">
                                <div class="media">
                                    <div class="media-body">

                                        <a href={{$assignment->course_name.'/detail/'.$assignment->id.'/post'}}><h3 class="media-heading">{{$assignment->title}}</h3></a>
                                        <p class="text-right">By : {{$assignment->creator_name}}</p>
                                        <p class="text-right">Date Created: {{$assignment->created_at->format('j M Y , g:ia')}}</p>                                 
                                    </div>
                                </div>
                            </div>
                            @empty
                                <p>No Post found</p>
                            @endforelse
                    @endif
                @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection