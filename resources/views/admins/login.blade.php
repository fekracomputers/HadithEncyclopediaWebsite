<!DOCTYPE html>
<html class="bg-black">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.2.0 Latest compiled and minified CSS -->
    <link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{asset('backend/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{asset('backend/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/icons-payment.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/flag-icon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/flag-icon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/typicons.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('backend/css/bonanzooka.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="bg-black">

<div class="form-box" id="login-box">
    <div class="header bg-green">
        <div class="logo">
            <strong>Admin</strong>
        </div>
    </div>
    <form action="{{ url('/login') }}" class="signin-wrapper" method="post">
        {{ csrf_field() }}
        <div class="body bg-white">

            <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button"><i class="fontello-user-1"></i>
                        </button>
                    </span>
                <input type="text" placeholder="Email" name="email" required class="form-control">
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <br>
            <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button"><i class="fontello-lock"></i>
                        </button>
                    </span>
                <input type="password" name="password" class="form-control" required placeholder="Password" />
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <br>
            <button type="submit" class="pull-right btn btn-success ">Sign In</button>

            <div class="form-group">
                <input type="checkbox" name="remember" />Remember me
            </div>
            {{--<hr class="timeline-hr">--}}
        </div>

    </form>

</div>


<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('admins/js/bootstrap.min.js')}}" type="text/javascript"></script>

</body>

</html>
