<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('project/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('project/css/style-admin.css') }}" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&family=Zen+Old+Mincho&display=swap" rel="stylesheet">
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
        @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error')}}
        </div>
        @endif
        @if(Session::has('check_email'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('check_email')}}
            </div>
        @endif
        <form action="{{route('postLogin')}}" method="post">
            @csrf
            <div class="box-right">
                <div class="title-top">
                    <h1>Hello Again!</h1>
                    <span>Welcome Back</span>
                </div>

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
