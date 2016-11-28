<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>UneLeap | Password Reset</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.css" type="text/css"/>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head>
    <body class="hold-transition lockscreen">
        <!-- Automatic element centering -->
        <div class="lockscreen-wrapper">
            <div class="lockscreen-logo">
                <a href="../../index2.html"><b>UneLeap</b></a>
            </div>
            @if (!empty($error))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ $error }}</li>
                </ul>
            </div>
            @endif
            <!-- User name -->
            <div class="lockscreen-name"></div>

            <!-- START LOCK SCREEN ITEM -->
            <div class="lockscreen-item">

                <form class="lockscreen-credentials" role="form" id='loginForm' method="POST" action="{{ url('/user/forgotPasswordSendEmail') }}" >
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input name="email" type="text" class="form-control validate[required,custom[email]]" placeholder="email">

                        <div class="input-group-btn">
                            <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="help-block text-center">
                Enter your email to retrieve new password in your Inbox
            </div>
            <div class="text-center">
                <a href="/login">Or sign in as a different user</a>
            </div>
            <div class="lockscreen-footer text-center">
                Copyright &copy; 2014-2016 <b><a href="/" class="text-black">UneLeap</a></b><br>
                All rights reserved
            </div>
        </div>
        <!-- /.center -->
<script type="text/javascript">

$(document).ready(function() {
      $("#loginForm").validationEngine();
});
</script>
        <!-- jQuery 2.2.3 -->
        <script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        <script  src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script  src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        
    </body>
</html>
