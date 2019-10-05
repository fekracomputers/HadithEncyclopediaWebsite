<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="lt-ie9 lt-ie8 lt-ie7" lang="en">
<![endif]-->

<!--[if IE 7]>
<html class="lt-ie9 lt-ie8" lang="en">
<![endif]-->

<!--[if IE 8]>
<html class="lt-ie9" lang="en">
<![endif]-->

<!--[if gt IE 8]>
  <!-->
<html lang="en">
<!--
<![endif]-->

<head>
    <meta charset="utf-8">
    <title>Hadith Admin</title>
    <meta name="author" content="Srinu Basava">
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport">
    <meta name="description" content="Hadith Admin">
    <meta name="keywords" content="Hadith Admin">
    <script src="{{asset('admin/js/html5-trunk.js')}}"></script>
    <link href="{{asset('admin/icomoon/style.css')}}" rel="stylesheet">
    <link href="{{asset('dist/css/jquery.dataTables.css')}}" rel="stylesheet">
    <!--[if lte IE 7]>
    <script src="{{asset('admin/css/icomoon-font/lte-ie7.js')}}"></script>
    <![endif]-->
    <link href="{{asset('admin/css/main.css')}}" rel="stylesheet">
</head>
<body>
<header>
    <a href="{{url('/admins')}}" class="logo">Hadith Admin</a>
    <div id="mini-nav">
        <ul class="hidden-phone">
            <li><a href="{{url('/logout')}}">Logout</a></li>
        </ul>
    </div>
</header>
<div class="container-fluid">
    <div id="mainnav" class="hidden-phone hidden-tablet">
        <ul>
            <li class="active">
                <a href="{{url('/admins')}}">
                    <div class="icon active">
                        <span class="fs1" aria-hidden="true" data-icon="&#xe0a1;"></span>
                    </div>
                    Dashboard
                </a>
            </li>

        </ul>
    </div>

    <div class="dashboard-wrapper">
        <div class="main-container">
            <div class="navbar hidden-desktop">
                <div class="navbar-inner">
                    <div class="container">
                        <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                  <span class="icon-bar">
                  </span>
                  <span class="icon-bar">
                  </span>
                  <span class="icon-bar">
                  </span>
                        </a>
                        <div class="nav-collapse collapse navbar-responsive-collapse">
                            <ul class="nav">
                                <li>
                                    <a href="{{url('admins')}}">Dashboard</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')

        </div>
    </div>
</div>

<footer>
    <p class="copyright">&copy; Hadith Admin</p>
</footer>

<script src="{{asset('dist/js/jquery.min.js')}}"></script>
<script src="{{asset('dist/js/jquery-ui.js')}}"></script>
<script src="{{asset('dist/js/bootstrap.js')}}"></script>
<script src="{{asset('dist/js/jquery.dataTables.js')}}"></script>
{{--<script src="{{asset('admin/js/jquery.sparkline.js')}}"></script>--}}

{{--<!-- Custom Js -->--}}
{{--<script src="{{asset('admin/js/custom-tables.js')}}"></script>--}}
{{--<script src="{{asset('admin/js/custom.js')}}"></script>--}}
<script src="{{asset('dist/js/app.js')}}"></script>
@yield('script')
</body>
</html>