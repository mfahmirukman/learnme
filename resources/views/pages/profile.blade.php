@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">View Profile</div>

                <div class="panel-body">
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
                    
                <table class="table table-bordered">
                @foreach($users as $user)
                <tbody>
                    <tr>
                    <td>Name</td>
                    <td>{{$user->name}}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                    <td>Email</td>
                    <td>{{$user->email}}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                    <td>Class</td>
                    <td>{{$user->class_name}}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                    <td>Role</td>
                    <td>{{$user->role}}</td>
                    </tr>
                </tbody>                 
                
                @endforeach
                </table>


                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
