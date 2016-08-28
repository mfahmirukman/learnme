@extends('layouts.app')

@section('content')
	<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                
                <style>
                    .table-bordered > tbody>tr>td:nth-child(1) {
                    width:200px;
                    text-align:center;
                    background-color:#2eafe8;
                    color:#ecf0f1;
                }
                .table-bordered > tbody>tr>td:nth-child(2) {
                    text-align:center;
                }
                </style>

                
                <div class="panel-heading">{{$course}}</div>
                <div class="panel-body">

                <br>



                

                {{-- */$count=1;/* --}}
                @foreach($materials as $material)
                <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td>Chapter</td>
                    <td>{{$material->chapter}}</td>
                  </tr>
                  <tr>
                    <td>Description</td>
                    <td>{{$material->description}}</td>
                  </tr>
                  <tr>
                      <td>Download</td>
                    <td><a href={{$material->r_link}}><button type="button" class="btn btn-success">Download</button></a>
                    </td>

                  </tr>
                  {{--*/$count++/*--}}
                </tbody>
                </table>
                <br>
                @endforeach
                
                </div>
                </div>
                <!-- <iframe width="420" height="315"
src="http://www.youtube.com/embed/XGSy3_Czz8k?autoplay=0">
</iframe> -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection