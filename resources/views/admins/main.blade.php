<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="themesmile" />
    <title>Admin</title>
    <meta name="description" content="hadith admin panel">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

    <!-- add styles -->
    <!-- bootstrap 3.2.0 Latest compiled and minified CSS -->
    <link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('/backend/css/slicknav.css')}}">
    <!-- font Awesome -->
    <link href="{{asset('backend/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{asset('backend/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/icons-payment.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/flag-icon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/typicons.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- Flag -->
    <link href="{{asset('backend/css/bonanzooka.css')}}" rel="stylesheet" type="text/css" />

    <link type="text/css" rel="stylesheet" id="theme" href="{{asset('backend/css/theme2.css')}}" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="{{asset('backend/css/css/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="{{asset('dist/css/jquery.dataTables.css')}}" rel="stylesheet">


    <script src="{{asset('backend/js/jquery-2.0.3.min.js')}}"></script>
    <script src="{{asset('backend/js/angular/angular.min.js')}}"></script>
    <script src="{{asset('backend/js/angular/angular-menu.js')}}"></script>
    <script src="{{asset('backend/js/angular/controllers.js')}}"></script>

    <script src="{{asset('dist/js/jquery.dataTables.js')}}"></script>






</head>

<body class="main-theme fixed">

<header class="header" >
    <!-- TOP NAVBAR -->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="hidden-xs navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <a href="{{url('/admins')}}"> <div class="hidden-xs logo">Admin</div></a>



        <!-- /.search form -->
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li><h5><a href="{{url('/logout')}}">Logout</a></h5></li>
            </ul>
        </div>
    </nav>






    <!-- /END OF TOP NAVBAR -->
    <script src="{{asset('backend/js/plugins/nicescroll/jquery.nanoscroller.js')}}"></script>

    <script>
        //Enable sidebar toggle
        $("[data-toggle='offcanvas']").click(function() {

            if ($(this).hasClass('active')) {
                $(this).removeClass('active')

                $('.leftmenu').animate({
                    left: 0
                }, 500);
                $(".navbar").animate({
                    left: 0
                }, 500);

                $(".right-side").animate({
                    "margin-left": "220px"
                }, 500);
            } else {
                $(this).addClass('active')
                //Else, enable content streching
                $('.leftmenu').animate({
                    left: -220
                }, 500);

                $(".navbar").animate({
                    left: -220
                }, 500);
                $(".right-side").animate({
                    "margin-left": "0px"
                }, 500);
            }
            return false;
        });


        // show skin select for a second
        setTimeout(function() {
            $("[data-toggle='offcanvas']").addClass('active').trigger('click');
        }, 10)

        $("[data-toggle='tooltip']").tooltip();

        /*
         * ADD SLIMSCROLL TO THE TOP NAV DROPDOWNS
         * ---------------------------------------
         */
        $(".navbar .menu").slimscroll({
            height: "200px",
            alwaysVisible: false,
            size: "3px"
        }).css("width", "100%");

        (function($) {
            $(".nano").nanoScroller();
        })(jQuery);

        $('.header-changer').styleSwitcher({
            manageCookieLoad: false
        });
    </script>

</header>


<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left Side Column. Contains Sidebar -->
    <aside class="hidden-xs leftmenu sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="image-avatar image">
                    <img src="{{asset('dist/img/books.png')}}" class="img-circle" alt="User Image" />
            <span><i class="fa fa-circle text-success"></i>
            </span>
                </div>
                <div class="info">
                    <p class="text-center">
                <span>Hello,
                    <strong>Admin</strong></span>
                    </p>
                </div>
            </div>

            <!-- SIDEBAR MENU: : style can be found in sidebar.less -->
            <br>
            <ul id="menu" class="sidebar-menu">

                <li class="active">
                    <a href="{{url('/admins')}}">
                        <i class="fa fontello-desktop-1"></i>
                        <span>Comments</span>
                    </a>
                </li>

            </ul>

        </section>
        <!-- /.sidebar -->

        <script>
            /* Sidebar tree view */
            (function($) {
                $(".sidebar .treeview").tree();
            })(jQuery);

            $('#menu').slicknav();
            //Activate tooltips
            $("[data-toggle='tooltip']").tooltip();

            function fix_sidebar() {
                //Make sure the body tag has the .fixed class
                if (!$("body").hasClass("fixed")) {
                    return;
                }

                //Add slimscroll
                $(".sidebar").slimscroll({
                    height: ($(window).height() - $(".header").height()) + "px",
                    color: "rgba(0,0,0,0.3)"
                });
            }
        </script>
    </aside>
    <!-- End of Left Side Column. Contains Sidebar -->
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- MAIN CONTENT -->
        <section class="content">

            <div style="position:relative">
            @yield('content')
            </div>

        </section>
        <!-- ./MAIN CONTENT -->
        <footer id="footer">

        </footer>
    </aside>
    <!-- /.right-side -->
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.10.3 -->
<script src="{{asset('backend')}}js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="{{asset('backend')}}js/bootstrap.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script type="text/javascript" src="{{asset('backend/js/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/weather/skycons.js')}}"></script>
<!-- Bonanzooka App -->
<script type="text/javascript" src="{{asset('backend/js/bonanzooka/app.js')}}"></script>
<!-- Bonanzooka dashboard demo (This is only for demo purposes) -->
<script type="text/javascript" src="{{asset('backend/js/bonanzooka/dashboard.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/jquery.slicknav.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/jquery.style-switcher.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('backend/js/plugins/input-mask/jquery.inputmask.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/js/plugins/input-mask/jquery.inputmask.date.extensions.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/js/plugins/input-mask/jquery.inputmask.extensions.js')}}" type="text/javascript"></script>
 <!-- DATA TABES SCRIPT -->
<script src="{{asset('backend/js/plugins/datatables/jquery.dataTables.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/js/plugins/datatables/dataTables.bootstrap.js')}}" type="text/javascript"></script>
<!-- FLOT -->
<script src="{{asset('backend/js/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/js/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/js/plugins/flot/jquery.flot.pie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/js/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>


</body>

</html>
