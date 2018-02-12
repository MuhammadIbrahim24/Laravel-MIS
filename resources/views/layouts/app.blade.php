<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NEDUET | MIS</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('http://fonts.googleapis.com/css?family=Open+Sans') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/icon.png') }}"> 
</head>
<body>
    <div id="app">
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <div id="LOGO">
                        <img src="{{ asset('img/LogoGrill.png') }}">
                    </div>
                   
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Middle Of Navbar -->
                    <ul class="nav navbar-nav navbar-middle" style="color: white;padding-left: 5%;">
                        <li><h1 style="font-size:55px;text-align:center;"><b>Management Information System<b><h1></li>
                        </br>
                        <li><h2 style="color:white;font-size:55px;text-align:center;"><b>Outcome Based Education</b><h2></li>
                    </ul>
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right" style="color:white;">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                
            </nav>   
            <!-- /. NAV TOP  -->
            
            @yield('navbar')

            @if (Request::is('login') OR Request::is('register') OR Request::is('passwod/reset') OR Request::is('password/email'))
                <div id="page-wrapper" style="margin-left: 0px;">
            @else
                <div id="page-wrapper" >
                @yield('navtop')
            @endif
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    
                    @yield('content')
                </div>
             <!-- /. PAGE INNER  -->
                
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
