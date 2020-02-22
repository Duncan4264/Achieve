 @extends('layout.achieveMaster')
@section('title', 'Register Page')

@section('content')
 <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post" action= "processRegister">
                <h2 class="text-center"><strong>Create</strong> an account.</h2>
                <input type="hidden" name = "_token" value = "<?php echo csrf_token()?>" />
                <div class="form-group"><input class="form-control" type="text" name="firstname" placeholder="First Name"></div>
                <div class="form-group"><input class="form-control" type="text" name="lastname" placeholder="Last Name"></div>
                <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username"></div>
                <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox">I agree to the license terms.</label></div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Sign Up</button></div><a class="already" href="#">You already have an account? Login here.</a></form>
        </div>
@endsection
        