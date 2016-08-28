@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if(str_contains($url = Request::url(),'post'))
                <div class="panel-heading">Post Question</div>
                <div class="panel-body">

                @include('layouts.partials.form_error')      
                    
                    {!! Form::open(['id'=>'post-question-forum']) !!}

                    {!! Form::label('title', 'Title')!!}
                    {!! Form::text('title', null, ['id' => 'title', 'class' =>'form-control', 'placeholder' => 'Your Question', 'required'])!!}
                    <br/>

                    {!! Form::label('course', 'Course')!!}
 
                    <br/>
                    <select name="course" class='form-control'>
                        @foreach($courses as $course)
                            <option value ="{{ $course->id}}">{{ $course->name}}</option>
                        @endforeach
                    </select>
                    <br/>

                    {!! Form::label('body', 'Body')!!}
                    {!! Form::textarea('body', null, ['id' => 'body', 'class' =>'form-control', 'placeholder' => 'Tell us about your question', 'required'])!!}
                    <br/>
                    {!! Form::button('Post Question', ['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit'])!!}
                    {!! Form::close()!!}

                <!-- if statement for inside the specific question -->
                @elseif(str_contains($url = Request::url(),'detail'))

                <div class="panel-heading">Detailed Forum</div>
                <div class="panel-body">
                <br>

                @forelse($threads as $thread)                
                <div class="well">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="media-heading" style="text-align:center">{{$thread->title}}</h3>
                            <p>Subject: {{$thread->course_name}}</p>
                            <p class="text-right">By : {{$thread->name}}</p>
                            <p class="text-right">{{$thread->role}}</p>
                            <p>{{$thread->body}}</p>
                            <ul class="list-inline list-unstyled">
                                <li><span><i class="glyphicon glyphicon-calendar"></i>{{$thread->created_at->format('j M Y , g:ia')}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- comments -->
                @forelse($comments as $comment)                
                <div class="well">
                    <div class="media">
                        <div class="media-body">
                            
                            
                            <p class="text-right">By : {{$comment->name}}</p>
                            <p class="text-right">{{$comment->role}}</p>
                            <p> {{$comment->comments}}</p>
                            <ul class="list-inline list-unstyled">
                                <li><span><i class="glyphicon glyphicon-calendar"></i>{{$thread->created_at->format('j M Y , g:ia')}}</span></li>
                            </ul>
                            @if(Auth::user()->name == $comment->name)
                                <a href= {{ '/forum/view/'.$thread->course_name.'/detail/'.$thread->slug.'/delete/'.$comment->comment_id}}><p class="text-right">Delete</p></a>
                            @endif
                            

                        </div>
                    </div>
                </div>
                @empty
                    <p>There is no reply to this question</p>
                @endforelse

                @empty
                    <p>No Post found</p>
                @endforelse
        



                {!! Form::open(['id'=>'post-comments-forum']) !!}
                    {!! Form::label('reply', 'Reply')!!}
                    {!! Form::textarea('comments', null, ['id' => 'comments', 'class' =>'form-control', 'placeholder' => 'Type your reply here', 'required'])!!}
                    <br/>
                    {!! Form::button('Post Comment', ['class' => 'btn btn-primary', 'type' => 'submit'])!!}
                {!! Form::close()!!}

                @elseif(str_contains($url = Request::url(),'view'))
                
                <div class="panel-heading">View Forum</div>
                <div class="panel-body">
                
                <p>Posted by Class {{$classes->class_name}}</p>
                <br>
                @forelse($threads as $thread)
                         
                <div class="well">
                    <div class="media">
                        <div class="media-body">
                            <a href={{ $thread->course_name.'/detail/'.$thread->slug}}><h3 class="media-heading">{{$thread->title}}</h3></a>
                            <p>Subject: {{$thread->course_name}}</p>
                            <p class="text-right">By : {{$thread->name}}</p>
                            <p>{{$thread->body}}</p>
                            <ul class="list-inline list-unstyled">
                                <li><span><i class="glyphicon glyphicon-calendar"></i>{{$thread->created_at->format('j M Y , g:ia')}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @empty
                    <p>No Post found</p>
                @endforelse


                @elseif(str_contains($url = Request::url(),'show'))
                <!-- show what subjects that the category specifies -->

                <div class="panel-heading">View Categories</div>
                <div class="panel-body">
                <br>

                @forelse($threads as $thread)                
                <a href={{'view/'.$thread->name}}><div class="well">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="media-heading" style="text-align:center">{{$thread->name}}</h3>
                        </div>
                    </div>
                </div>
                </a>

                @empty
                    <p>No Post found</p>
                @endforelse

                

                @endif
                                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
