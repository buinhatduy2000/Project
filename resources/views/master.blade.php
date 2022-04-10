<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Documents</title>
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
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&family=Zen+Old+Mincho&display=swap"
        rel="stylesheet" />
    @yield('css')
</head>

<body>
    @if (Auth::guard('account')->user()->role == \App\Models\Account::ACCOUNT_ADMIN)
        <div class="admin-header">
            <div class="admin-logo">
                <img src="{{ asset('project/img/logo.png') }}" alt="">
            </div>
            <div class="admin-img-login">
                <img src="{{ asset('project/img/img_login.png') }}" alt="">
            </div>
        </div>
        <div class="admin-content">
            <div class="admin-content-left">
                <div class="admin-box-function">
                    <span class="admin-title">Manage</span>
                    <div onclick="activeMenu(0)" class="menu">
                        <img src="{{ asset('project/img/viewSite.png') }}" alt="">
                        <a href="{{ route('home') }}">
                            <span>View Site</span>
                    </div>
                    <div onclick="activeMenu(1)" class="menu">
                        <a href="{{ route('category.index') }}">
                            <img src="{{ asset('project/img/document.png') }}" alt="">
                            <span>Documents</span>
                        </a>
                    </div>
                    <div onclick="activeMenu(2)" class="menu">
                        <img src="{{ asset('project/img/users.png') }}" alt="">
                        <a href={{ route('adminListUser') }}>
                            <span>Users</span>
                        </a>

                    </div>
                    <div onclick="activeMenu(3)" class="menu">
                        <img src="{{ asset('project/img/Archived.png') }}" alt="">
                        <span>Archived pages</span>
                    </div>

                    <a href="{{ route('logout') }}"><button class="btn-logOut">Log Out</button></a>
                </div>
            </div>
            @yield('content')
        @else
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
                    <div class="header-middle"><a href="{{ route('home') }}"><img
                                src="{{ asset('project/img/logo.png') }}" alt="logo"></a></div>
                    <div class="header-right">
                        <div class="header-search-box">
                            <input class="search-box" placeholder="Search" />
                            <button class="search-box-btn" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        @if (Auth::guard('account')->check())
                            <div class="user-box">
                                <div class="dropdown">
                                    <div class="login-infor-user" data-bs-toggle="dropdown">
                                        <img src="{{ asset('project/img/avatar.png') }}" alt="">
                                        <div class="login-infor-user-name">
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
                                        @if (Auth::guard('account')->user()->role == \App\Models\Account::ACCOUNT_QAM)
                                            <li><a class="dropdown-item"
                                                    href="{{ route('dashboard') }}">Dashboard</a></li>
                                        @endif
                                        @if (Auth::guard('account')->user()->role == \App\Models\Account::ACCOUNT_ADMIN)
                                            <li><a class="dropdown-item" href="{{ route('adminListUser') }}">List
                                                    User</a>
                                            </li>
                                        @endif
                                        @if (Auth::guard('account')->user()->role == \App\Models\Account::ACCOUNT_STAFF)
                                            <li><a class="dropdown-item" href="{{ route('idea.create') }}">New
                                                    Idea</a></li>
                                        @endif
                                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="login-box">
                                <button><a href="{{ route('login') }}">Login</a></button>
                            </div>
                        @endif
                        <div class="tbody-responsive-navbar">
                            <button class="btn btn-secondary" id="navbar-item"><i class="bi bi-list"></i></button>
                            <button class="btn btn-secondary" id="navbar-item-cancel"><i
                                    class="bi bi-list"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="navbar-item-detail">
                <div class="login-infor-user" data-bs-toggle="dropdown">
                    <img src="{{ asset('project/img/avatar.png') }}" alt="">
                    <div class="login-infor-user-name">
                        <p>{{ Auth::guard('account')->user()->personal_info->first_name .' ' .Auth::guard('account')->user()->personal_info->last_name }}
                        </p>
                        <h6>{{ ucfirst(trans(Auth::guard('account')->user()->role)) }}</h6>
                    </div>
                </div>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    @if (Auth::guard('account')->user()->role !== \App\Models\Account::ACCOUNT_ADMIN)
                        <li><a href="{{ route('idea.create') }}">New Idea</a></li>
                    @endif
                    @if (Auth::guard('account')->user()->role === \App\Models\Account::ACCOUNT_ADMIN)
                        <li><a href="{{ route('adminListUser') }}">List User</a></li>
                    @endif
                    @if (Auth::guard('account')->user()->role === \App\Models\Account::ACCOUNT_QAM)
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif
                    <li><a class="dropdown-item"
                            href="{{ route('viewInfo', ['id' => Auth::guard('account')->user()->id]) }}">View
                            Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
            <div class="tbody">
                <div class="tbody-box-responsive">
                    <form class="d-flex">
                        <input class="btn btn-outline-success" type="button" id="category" value="Category" />
                        <input class="btn btn-outline-success" type="button" id="cate-cancel" value="Category" />
                    </form>
                </div>
                <div class="tbody-sitebar-responsive" id="cate-ct">
                    <h4>
                        @if (Auth::guard('account')->user()->role === \App\Models\Account::ACCOUNT_ADMIN || Auth::guard('account')->user()->role === \App\Models\Account::ACCOUNT_QAM)
                            <a href="{{ route('category.index') }}">Category</a>
                        @endif
                    </h4>
                    <ul>
                        @foreach ($category as $item)
                            @if (date('Y-m-d') < $item->second_closure_date)
                                <li><a href="/category-by-id/{{ $item->id }}">{{ $item->category_name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="tbody-sitebar col col-sm-3 col-lg-2">
                    <h4>
                        @if (Auth::guard('account')->user()->role === \App\Models\Account::ACCOUNT_ADMIN || Auth::guard('account')->user()->role === \App\Models\Account::ACCOUNT_QAM)
                            <a href="{{ route('category.index') }}">Category</a>
                        @else
                            Category
                        @endif
                    </h4>
                    <ul>
                        @foreach ($category as $item)
                            @if (date('Y-m-d') < $item->second_closure_date)
                                <li><a href="/category-by-id/{{ $item->id }}">{{ $item->category_name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @yield('content')
            </div>
            <div class="footer">
                <div class="footer-1">
                    <div class="intro-gr3 col col-lg-4">
                        <h5>Group3</h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Sit viverra massa elit ornare nulla varius nisi arcu.
                        </p>
                        <h4>+44 322 11 00</h4>
                    </div>
                    <div class="footer-member">
                        <p>FrontE</p>
                        <p>Minh</p>
                        <p>Dung</p>
                    </div>
                    <div class="footer-member">
                        <p>BackE</p>
                        <p>Toan</p>
                        <p>Duy</p>
                    </div>
                    <div class="footer-member">
                        <p>Tester</p>
                        <p>Nam</p>
                        <p>Bien</p>
                    </div>
                </div>
                <div class="footer-2">
                    <p>2022 © All rights reserved. Created by Group3</p>
                </div>
            </div>
    @endif

    <script language="javascript">
        document.getElementById("navbar-item").onclick = function() {
            document.getElementById("navbar-item-detail").style.display =
                "block";
            document.getElementById("navbar-item-cancel").style.display =
                "block";
            document.getElementById("navbar-item").style.display = "none";
        };
        document.getElementById("navbar-item-cancel").onclick =
            function() {
                document.getElementById(
                    "navbar-item-detail"
                ).style.display = "none";
                document.getElementById(
                    "navbar-item-cancel"
                ).style.display = "none";
                document.getElementById("navbar-item").style.display =
                    "block";
            };
        document.getElementById("category").onclick = function() {
            document.getElementById("cate-ct").style.display = "block";
            document.getElementById("cate-cancel").style.display = "block";
            document.getElementById("category").style.display = "none";
        };
        document.getElementById("cate-cancel").onclick = function() {
            document.getElementById("cate-ct").style.display = "none";
            document.getElementById("cate-cancel").style.display = "none";
            document.getElementById("category").style.display = "block";
        };
    </script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('project/js/main.js') }}"></script>
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
