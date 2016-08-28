@extends('layouts.app')

@section('content')
	<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if(str_contains($url = Request::url(),'view'))
                <div class="panel-heading">Courses of {{$user->class_name}}</div>
                    <div class="panel-body">

                        <br>
                        <br>


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course Name</th>
                                    <th>Chapter</th>
                                    <th>Reading Material</th>
                                    <th>Supporting Material</th>
                                </tr>
                            </thead>
                        {{-- */$count=1;/* --}}
                        @foreach($materials as $material)
                            <tbody>
                              
                              <tr>
                                <td>{{$count}}</td>
                                <td>{{$material->name}}</td>
                                <td>{{$material->chapter}}</td>
                                <td><a href={{'read/'.$material->name.'/'.$material->id}}>Available</a>
                                </td>

                                <td><a href={{'support/'.$material->name.'/'.$material->id}}>Available</a></td>
                                <!-- <td>{{$material->fname}}</td> -->
                              </tr>
                              {{--*/$count++/*--}}
                            </tbody>
                        @endforeach
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection