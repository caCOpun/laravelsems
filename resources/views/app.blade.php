<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('js/select2/select2.min.css') }}" rel="stylesheet" media="all">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">HEADER</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">Home</a></li>
                @if (Auth::check())
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    @if(Auth::user()->hasRole('admin'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">Roles/Permissions</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/role_permission') }}">Panel</a></li>

                                <li><a href="{{ URL::route('roles.index') }}">Roles</a></li>
                                <li><a href="{{ URL::route('permissions.index') }}">Permissions</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff') )
                        <li><a href="{{ URL::route('users.index') }}">Users</a></li>
                        <li><a href="{{ URL::route('years.index') }}">Years</a></li>
                        <li><a href="{{ URL::route('semesters.index') }}">Semester</a></li>
                        <li><a href="{{ URL::route('subjects.index') }}">Subject</a></li>
                        <li><a href="{{ URL::route('students.index') }}">Student</a></li>
                    @endif
                    @if(Auth::user()->hasRole('student'))
                        <li><a href="{{ URL::route('checks.create') }}">student</a></li>
                    @endif
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    <li><a href="{{ url('/auth/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @include('flash::message')
    @yield('content')
</div>

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="{{ asset('js/select2/select2.min.js') }}"></script>
<script type="text/javascript">
    $('.select2-multi').select2();
</script>
</body>
</html>
