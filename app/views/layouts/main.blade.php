<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>adBoom Admin</title>
    {{ HTML::style('http://code.jquery.com/mobile/1.4.1/jquery.mobile-1.4.1.min.css') }}
    {{ HTML::style('css/main.css')}}

    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript">
    $(document).bind("mobileinit", function () {
        $.mobile.ajaxEnabled = false;
    });
    </script>
    <script src="http://code.jquery.com/mobile/1.4.1/jquery.mobile-1.4.1.min.js"></script>
    
</head>
<body>

<div class="container">
    <div class="header">
        
        <img src='http://adboomgrp.com/images/logo.png'>
        
        <span style="float:right;">
        @if(!Auth::check())
            <a href="/users/register" class="ui-btn ui-btn-inline">Register</a>
            <a href="/users/login" class="ui-btn ui-btn-inline">Login</a>
        @else
            <a href="/users/logout" class="ui-btn ui-btn-inline">Logout</a>
        @endif
        </span>
    </div>
    
    <div class="content">
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
        
        <div class="content">
            {{ $content }}
        </div>
    </div>
    
    <div class="footer">
        
    </div>
</div>
    
</body>
</html>
