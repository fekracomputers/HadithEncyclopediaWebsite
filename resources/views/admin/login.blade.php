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
    <meta name="author" content="Hadith Login">
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport">
    <meta name="description" content="Hadith Admin">
    <meta name="keywords" content="Hadith Admin">
    <script src="{{asset('admin/js/html5-trunk.js')}}"></script>
    <link rel="stylesheet" href="{{asset('admin/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/main.css')}}">

    <!--[if lte IE 7]>
    <script src="{{asset('admin/css/icomoon-font/lte-ie7.js')}}"></script>
    <![endif]-->

</head>
<body>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span4 offset4">
            <div class="signin">
                <h1 class="center-align-text">Login</h1>
                <form action="{{ url('/login') }}" class="signin-wrapper" method="post">
                    {{ csrf_field() }}

                    <div class="content">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input class="input input-block-level" placeholder="Email" type="email" value="" name="email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div>
                            <input class="input input-block-level" placeholder="Password" type="password" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="actions">
                        <input class="btn btn-info pull-right" type="submit" value="Login">

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('admin/js/jquery.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.js')}}"></script>

</body>
</html>