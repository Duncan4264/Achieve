@extends('layout.achieveMaster')
@section('title', 'Login Page')

@section('content')
          <div class="login-dark">
        <form method="post" action="processLogin">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            {{$errors->first('username')}}
            {{$errors->first('password')}}
            <input type="hidden" name = "_token" value = "<?php echo csrf_token() ?>" />
            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username" maxlength=20></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" maxlength=20></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div><a class="forgot" href="#">Forgot your email or password?</a></form>
    </div>


@endsection
