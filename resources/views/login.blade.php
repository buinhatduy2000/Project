<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('project/css/style.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
          integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
<div class="login">
    <div class="login-left">
        <div class="box-left">
            <h1>Group 3 university</h1>
            <span>A secure web-based role-based system</span>
            <button>Get Started</button>
        </div>
    </div>
    <div class="login-right">
        <form action="{{route('postLogin')}}" method="post">
            @csrf
            <div class="box-right">
                <div class="title-top">
                    <h1>Hello Again!</h1>
                    <span>Welcome Back</span>
                </div>
                @if(Session::has('check_email'))
                    <p class="login-error">{{Session::get('check_email')}}</p>
                @endif
                <div class="box-title">
                    <div class="box-account">
                        <div class="box-top">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="User Name" name="user_name" value="{{old('user_name')}}">
                        </div>
                    </div>
                    <div class="box-password">
                        <div class="box-bottom">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Password" name="password">
                        </div>
                    </div>
                </div>
                <div class="title-bottom">
                    Remember me<input type="checkbox" name="remember">
                    <span>Forgot Password</span>
                </div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</div>
<script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js"
        integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
