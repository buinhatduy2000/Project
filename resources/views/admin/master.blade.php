<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('project/css/style-admin.css')}}" />
    <link rel="stylesheet" href="{{asset('project/css/style.css')}}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
          integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <title>Admin</title>
    @yield('css')
</head>

<body>
    <div class="admin-header">
        <div class="admin-logo">
            <a href="{{route('home')}}"><img src="{{asset('project/img/logo.png')}}" alt=""></a>
        </div>
        <a href="{{route('logout')}}">
            <div class="admin-img-login">
                <img src="{{asset('project/img/img_login.png')}}" alt="">
            </div>
        </a>
    </div>
    <div class="admin-content">
        <div class="admin-content-left">
            <div class="admin-box-function">
                <div onclick="activeMenu(0)" class="active-bgr menu">
                    <img src="{{asset('project/img/viewSite.png')}}" alt="">
                    <span>View Ideas</span>
                </div>
                <a href="{{route('category.index')}}" id="category-button">
                    <div onclick="activeMenu(1)" class="menu">
                        <img src="{{asset('project/img/document.png')}}" alt="">
                        <span for="category-button">Categories</span>
                    </div>
                </a>
                <a href="{{route('adminListUser')}}">
                    <div onclick="activeMenu(2)" class="menu">
                        <img src="{{asset('project/img/users.png')}}" alt="">
                        <span>Users</span>
                    </div>
                </a>
                <div onclick="activeMenu(3)" class="menu">
                    <img src="{{asset('project/img/icon4.png')}}" alt="">
                    <span>Dashboard</span>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
</body>
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js"
            integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function activeMenu(index) {
            const itemMenu = document.getElementsByClassName('menu')
            for (var i = 0; i < 4; i++) {
                if (i == index) {
                    itemMenu[i].setAttribute('class', 'active-bgr menu');
                } else {
                    itemMenu[i].setAttribute('class', 'menu');
                }
            }
        }
    </script>
    @yield('script')
</html>
