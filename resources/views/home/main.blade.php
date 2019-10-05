<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> موسوعة الحديث@yield('title')</title>
    <link rel="stylesheet" href="{{asset('dist/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/uikit.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/flipped.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{asset('dist/img/favicon.png')}}"/>
    <link href="{{asset('dist/css/bootstrap-editable.css')}}" rel="stylesheet">


</head>
<body>
@include('home.analyticstracking')
<div class="container main">
    <div class="shadow">
        <header>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand text-center" href="{{url('/')}}">
                            <img alt="Brand" src="{{asset('dist/img/New-logo.png')}}" class="img-logo" alt="logo" title="موسوعة الحديث">
                        </a>
                    </div>
                </div>
            </nav>
            <!--end of navbar inverse-->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="{{url('/')}}" title="الرئيسية">الرئيسية</a></li>
                            <li><a href="{{url('/topic')}}" title="الموضوعات">الموضوعات</a></li>
                            <li><a href="{{url('/all-books')}}" title="الكتب">الكتب</a></li>
                            <li><a href="{{url('/all-narrators')}}" title="الرواة">الرواة</a></li>
                            <li><a href="{{url('/authors')}}" title="المؤلفين">المؤلفين</a></li>
                            <li><a href="{{url('/mybooks')}}" title="كتبي">كتبي</a></li>
                            <li><a href="{{url('/about')}}" title="عن الموقع">عن الموقع</a>
                        </ul>
                        <form class="navbar-form navbar-right hidden-xs" action="{{url('/search-hadith')}}" method="get">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="ui-widget">
                                <input type="text" id="seInput" name="search" class="form-control" placeholder="Search" required>
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-default">ابحث</button>

                        </form>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
                <div class="search-body visible-xs">
                    <form class="navbar-form" action="{{url('/search-hadith')}}" method="get">
                        <div class="input-group">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-default uk-margin-left">ابحث</button>
                            </span>
                            <input type="text" name="search" class="form-control" placeholder="Search" required>
                        </div><!-- /input-group -->

                    </form>

                </div>

        </header>
        <!--end of header-->

        @yield('content')

        <footer class="nav">
            <nav class="navbar navbar-inverse ">
                <div class="container-fluid">
                    <div class="text-center">
                        <h5 class="text-primary">صمم وطور بواسطة فكرة كمبيوتر &copy;</h5>
                    </div>
                </div>
            </nav>

        </footer>

    </div>



</div>
<!--end of content container-->

<!--end main container-->

<!--javascript files-->
<script src="{{asset('dist/js/jquery.min.js')}}"></script>
<script src="{{asset('dist/js/jquery-ui.js')}}"></script>
<script src="{{asset('dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('dist/js/bootstrap-editable.js')}}"></script>
<script src="{{asset('dist/js/uikit.min.js')}}"></script>
<script src="{{asset('dist/js/slideshow.min.js')}}"></script>
<script src="{{asset('dist/js/tooltip.js')}}"></script>
<script src="{{asset('dist/js/app.js')}}"></script>

@yield('script')


</body>
</html>