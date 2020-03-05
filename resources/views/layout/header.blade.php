<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register</title>
    
    <script src="bootstrap/assets/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="bootstrap/assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="botstrap/assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="bootstrap/assets/css/Registration-Form-with-Photo.css">
     <link rel="stylesheet" href="bootstrap/assets/css/styles.css">
    
    <script src="bootstrap/assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="bootstrap/assets/css/styles.css">
    <link rel="stylesheet" href="bootstrap/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="bootstrap/assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="bootstrap/assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="bootstrap/assets/css/Navigation-with-Button.css">
    
    
</head>
<nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="login">Achieve</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                @if(Session::has('users'))
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="login">Feed</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="profile">Profile</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="groups">Groups</a></li>
                       @endif 
                        @if(Session::has('admin'))
                    <li class="nav-item" role="presentation"><a class="nav-link" href="admin">Admin</a></li>
                     <li class="nav-item" role="presentation"><a class="nav-link" href="jobadmin">Job Admin</a></li>
                    @endif
                    </li>
                 
        			
        			@if(Session::has('users'))
        			</ul><span class="navbar-text actions"> <a class="login" href="logout">Log out</a></span> 
					@else
    					</ul><span class="navbar-text actions"> <a class="login" href="login">Log In</a><a class="btn btn-light action-button" role="button" href="register">Sign Up</a></span></div> 
    				@endif
        </div>
 </nav>