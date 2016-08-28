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
                <table class="table table-bordered" style="table-layout:fixed" width="100%">
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
                      <td>Video</td>
                    <td><iframe width="320" height="240" src={{$material->s_link}} frameborder="1" allowfullscreen></iframe></td>
                    
                  </tr>
                  {{--*/$count++/*--}}
                </tbody>
                </table>
                <br>
                @endforeach
                
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection