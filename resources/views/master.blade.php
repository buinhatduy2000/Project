<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
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
    @yield('css')
</head>

<body>
    <div class="header">
        <div class="header-navbar">
            <div class="header-left">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="">Startpage</a></li>
                    <li><a href="">Follow</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </div>
            <div class="header-middle"><a href="{{ route('home') }}"><img src="{{ asset('project/img/logo.png') }}"
                        alt="logo"></a></div>
            <div class="header-right">
                <div class="header-search-box">
                    <input class="search-box" placeholder="Search" />
                    <button class="search-box-btn" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                @if (Auth::guard('account')->check())
                    <div class="login-box">
                        <div class="dropdown">
                            <div class="infor-user" data-bs-toggle="dropdown">
                                <img src="{{ asset('project/img/avatar.png') }}" alt="">
                                <div class="infor-user-name">
                                    <p>{{ Auth::guard('account')->user()->personal_info->first_name .' ' .Auth::guard('account')->user()->personal_info->last_name }}
                                    </p>
                                    <h6>{{ ucfirst(trans(Auth::guard('account')->user()->role)) }}</h6>
                                </div>
                                <p><i class="bi bi-chevron-down"></i></p>
                            </div>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item"
                                        href="{{ route('viewInfo', ['id' => Auth::guard('account')->user()->id]) }}">View
                                        Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('idea.create') }}">New Docs</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="login-box">
                        <button><a href="{{ route('login') }}">Login</a></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="tbody">
        <div class="tbody-sitebar col col-sm-3 col-lg-2">
            <h4><a href={{ route('category.index') }}>Category</a></h4>
            <ul>
                @foreach ($category as $item)
                    <li><a href="/category-by-id/{{ $item->id }}">{{ $item->category_name }}</a></li>
                @endforeach
            </ul>
        </div>
        @yield('content')
    </div>

    <div class="footer">
        <div class="footer-1">
            <div class="intro-gr3">
                <h5>Group3</h5>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit viverra
                    massa elit ornare nulla varius nisi arcu.
                </p>
                <h4>+44 322 11 00</h4>
            </div>
            <div class="tool">
                <ul>
                    <li>Front End</li>
                    <li>Minh</li>
                    <li>Dung</li>
                </ul>
                <ul>
                    <li>Back End</li>
                    <li>Toan</li>
                    <li>Duy</li>
                </ul>
                <ul>
                    <li>Test Web</li>
                    <li>Nam</li>
                    <li>Bien</li>
                </ul>
            </div>
        </div>
        <div class="footer-2">
            <p>2022 © All rights reserved. Created by Group3</p>
        </div>
    </div>

</body>
@yield('script')

</html>
