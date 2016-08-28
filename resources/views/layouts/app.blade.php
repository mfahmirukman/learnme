<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>78 E-Learning</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}


    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .navbar-default {
          background-color: #2eafe8;
          border-color: #228bba;
        }
        .navbar-default .navbar-brand {
          color: #ecf0f1;
        }
        .navbar-default .navbar-brand:hover,
        .navbar-default .navbar-brand:focus {
          color: #9cd9f4;
        }
        .navbar-default .navbar-text {
          color: #ecf0f1;
        }
        .navbar-default .navbar-nav > li > a {
          color: #ecf0f1;
        }
        .navbar-default .navbar-nav > li > a:hover,
        .navbar-default .navbar-nav > li > a:focus {
          color: #9cd9f4;
        }
        .navbar-default .navbar-nav > li > .dropdown-menu {
          background-color: #2eafe8;
        }
        .navbar-default .navbar-nav > li > .dropdown-menu > li > a {
          color: #ecf0f1;
        }
        .navbar-default .navbar-nav > li > .dropdown-menu > li > a:hover,
        .navbar-default .navbar-nav > li > .dropdown-menu > li > a:focus {
          color: #9cd9f4;
          background-color: #228bba;
        }
        .navbar-default .navbar-nav > li > .dropdown-menu > li > .divider {
          background-color: #228bba;
        }
        .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
        .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
        .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
          color: #9cd9f4;
          background-color: #228bba;
        }
        .navbar-default .navbar-nav > .active > a,
        .navbar-default .navbar-nav > .active > a:hover,
        .navbar-default .navbar-nav > .active > a:focus {
          color: #9cd9f4;
          background-color: #228bba;
        }
        .navbar-default .navbar-nav > .open > a,
        .navbar-default .navbar-nav > .open > a:hover,
        .navbar-default .navbar-nav > .open > a:focus {
          color: #9cd9f4;
          background-color: #228bba;
        }
        .navbar-default .navbar-toggle {
          border-color: #228bba;
        }
        .navbar-default .navbar-toggle:hover,
        .navbar-default .navbar-toggle:focus {
          background-color: #228bba;
        }
        .navbar-default .navbar-toggle .icon-bar {
          background-color: #ecf0f1;
        }
        .navbar-default .navbar-collapse,
        .navbar-default .navbar-form {
          border-color: #ecf0f1;
        }
        .navbar-default .navbar-link {
          color: #ecf0f1;
        }
        .navbar-default .navbar-link:hover {
          color: #9cd9f4;
        }
        .panel-default > .panel-heading {
            background-color:#2eafe8;
            color:#ecf0f1;
        }
        .table-bordered > thead,.table-bordered > thead >tr>th {
            background-color:#2eafe8;
            color:#ecf0f1;
            text-align:center;
        }
        .table-bordered > tbody>tr>td {
            
            text-align:center;
        }


        .jumbotron{
            background-color: #2eafe8; 
            color: #9cd9f4;
            text-align:center;                        
        }
        .jumbotron p{
            color: #9cd9f4;
            text-align:center;
            font-weight: bold;
        }
        .well {
            color:#ecf0f1;
            background-color: #2eafe8; 
        }

 

        @media (max-width: 767px) {
          .navbar-default .navbar-nav .open .dropdown-menu > li > a {
            color: #ecf0f1;
          }
          .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
          .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
            color: #9cd9f4;
          }
          .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
          .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
          .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
            color: #9cd9f4;
            background-color: #228bba;
          }
        }

    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    SMAN 78
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if(Auth::guest())
                        
                    @elseif(Auth::user())
                        <li>{!! link_to_route('get_courses', 'Courses')!!}</li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Forum<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/forum/post') }}"><span class="glyphicon glyphicon-user"></span>Post a Thread</a></li>
                                
                                <li><a href="{{ url('/forum/show') }}"><span class="glyphicon glyphicon-user"></span>View Forum</a></li>
                                
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Assignment<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if(str_contains(Auth::user()->role, 'teacher'))
                                    <li><a href="{{ url('/assignment/post') }}"><span class="glyphicon glyphicon-user"></span>Post Assignment</a></li>
                                @endif
                                <li><a href="{{ url('/assignment/show') }}"><span class="glyphicon glyphicon-user"></span>View Assignment</a></li>
                            </ul>
                        </li>
                        
                        @endif
                    
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{{ url('/login') }}}">Login</a></li>
                        <!-- <li>{!! link_to_route('get_register', 'Register') !!}</li> -->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('profile/view') }}"><span class="glyphicon glyphicon-user"></span>View Profile</a></li>
                                
                                <!-- <li><a href="{{ url('#') }}"><i class="fa fa-qq"></i>Reset Password</a></li> -->

                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
