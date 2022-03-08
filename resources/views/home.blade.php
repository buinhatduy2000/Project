<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="{{asset('project/css/style.css')}}" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&family=Zen+Old+Mincho&display=swap" rel="stylesheet">
</head>

<body>
<div class="header">
    <div class="header-navbar">
        <div class="header-left">
            <ul>
                <li><a href="./home.html">Home</a></li>
                <li><a href="">Startpage</a></li>
                <li><a href="">Follow</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </div>
        <div class="header-middle"><img src="../img/logo.png" alt=""></div>
        <div class="header-right">
            <div class="header-search-box">
                <input class="search-box" placeholder="Search" />
                <button class="search-box-btn" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
            @if(Auth::guard('account')->check() )
                <div class="login-box">
                    <div class="dropdown">
                        <div class="infor-user" data-bs-toggle="dropdown">
                            <img src="../project/img/avatar.png" alt="">
                            <div class="infor-user-name">
                                <p>Oliver Smith</p>
                                <h6>Teacher English</h6>
                            </div>
                            <p><i class="bi bi-chevron-down"></i></p>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">View Profile</a></li>
                            <li><a class="dropdown-item" href="#">New Docs</a></li>
                            <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            @else
                <div class="login-box">
                    <button><a href="{{route('login')}}">Login</a></button>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="tbody-home">
    <div class="tbody">
        <div class="tbody-sitebar">
            <h4><a href="./category.html">Category</a></h4>
            <ul>
                <li><a href="">Book</a></li>
                <li><a href="">Community</a></li>
                <li><a href="">Infrastructure</a></li>
                <li><a href="">Subjects</a></li>
                <li><a href="">Service</a></li>
                <li><a href="">School fee</a></li>
                <li><a href="">Sharing experiences</a></li>
                <li><a href="">Rank and position</a></li>
                <li><a href="">Homework</a></li>
                <li><a href="">Exam</a></li>
                <li><a href="">Game</a></li>
            </ul>
        </div>
        <div class="tbody-content">
            <div class="tbody-filter">
                <div class="tbody-filter-left">
                    <p>Documents</p>
                </div>
                <div class="tbody-filter-right">
                    <p><i class="bi bi-dash"></i>&emsp;Filter&emsp;</p>
                    <div class="tbody-dropdown">
                        <button class="tbody-dropbtn">Choose sort order</button>
                        <div class="tbody-dropdown-ct">
                            <a href="#">Link 1</a>
                            <a href="#">Link 2</a>
                            <a href="#">Link 3</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tbody-documents">
                <div class="tbody-doc-left">
                    <h3>Sed ut perspiciatis</h3>
                    <p>
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                        aut fugit, sed quia consequuntur magni dolores eos qui ratione
                        voluptatem sequi nesciunt. Neque porro quisquam est.
                    </p>
                    <p class="author">Oliver Smith - 6 Jan, 2020</p>
                </div>
                <div class="tbody-doc-right">
                    <p><i class="bi bi-calendar2-week"></i> 22-01-22 to 22-01-22</p>
                    <button class="btn btn-outline-success">Download</button>
                    <button class="btn btn-outline-secondary"><a href="./detail.html">See More</a></button>
                    <p class="view">
                        <i class="bi bi-tag"></i> Book &emsp;&emsp;&emsp;&nbsp;
                        <i class="bi bi-people-fill"></i> 2300
                    </p>
                </div>
            </div>
            <div class="tbody-documents">
                <div class="tbody-doc-left">
                    <h3>Sed ut perspiciatis</h3>
                    <p>
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                        aut fugit, sed quia consequuntur magni dolores eos qui ratione
                        voluptatem sequi nesciunt. Neque porro quisquam est.
                    </p>
                    <p class="author">Oliver Smith - 6 Jan, 2020</p>
                </div>
                <div class="tbody-doc-right">
                    <p><i class="bi bi-calendar2-week"></i> 22-01-22 to 22-01-22</p>
                    <button class="btn btn-outline-success">Download</button>
                    <button class="btn btn-outline-secondary"><a href="./detail.html">See More</a></button>
                    <p class="view">
                        <i class="bi bi-tag"></i> Book &emsp;&emsp;&emsp;&nbsp;
                        <i class="bi bi-people-fill"></i> 2300
                    </p>
                </div>
            </div>
            <div class="tbody-documents">
                <div class="tbody-doc-left">
                    <h3>Sed ut perspiciatis</h3>
                    <p>
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                        aut fugit, sed quia consequuntur magni dolores eos qui ratione
                        voluptatem sequi nesciunt. Neque porro quisquam est.
                    </p>
                    <p class="author">Oliver Smith - 6 Jan, 2020</p>
                </div>
                <div class="tbody-doc-right">
                    <p><i class="bi bi-calendar2-week"></i> 22-01-22 to 22-01-22</p>
                    <button class="btn btn-outline-success">Download</button>
                    <button class="btn btn-outline-secondary"><a href="./detail.html">See More</a></button>
                    <p class="view">
                        <i class="bi bi-tag"></i> Book &emsp;&emsp;&emsp;&nbsp;
                        <i class="bi bi-people-fill"></i> 2300
                    </p>
                </div>
            </div>
            <div class="tbody-documents">
                <div class="tbody-doc-left">
                    <h3>Sed ut perspiciatis</h3>
                    <p>
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                        aut fugit, sed quia consequuntur magni dolores eos qui ratione
                        voluptatem sequi nesciunt. Neque porro quisquam est.
                    </p>
                    <p class="author">Oliver Smith - 6 Jan, 2020</p>
                </div>
                <div class="tbody-doc-right">
                    <p><i class="bi bi-calendar2-week"></i> 22-01-22 to 22-01-22</p>
                    <button class="btn btn-outline-success">Download</button>
                    <button class="btn btn-outline-secondary"><a href="./detail.html">See More</a></button>
                    <p class="view">
                        <i class="bi bi-tag"></i> Book &emsp;&emsp;&emsp;&nbsp;
                        <i class="bi bi-people-fill"></i> 2300
                    </p>
                </div>
            </div>
            <div class="tbody-documents">
                <div class="tbody-doc-left">
                    <h3>Sed ut perspiciatis</h3>
                    <p>
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                        aut fugit, sed quia consequuntur magni dolores eos qui ratione
                        voluptatem sequi nesciunt. Neque porro quisquam est.
                    </p>
                    <p class="author">Oliver Smith - 6 Jan, 2020</p>
                </div>
                <div class="tbody-doc-right">
                    <p><i class="bi bi-calendar2-week"></i> 22-01-22 to 22-01-22</p>
                    <button class="btn btn-outline-success">Download</button>
                    <button class="btn btn-outline-secondary"><a href="./detail.html">See More</a></button>
                    <p class="view">
                        <i class="bi bi-tag"></i> Book &emsp;&emsp;&emsp;&nbsp;
                        <i class="bi bi-people-fill"></i> 2300
                    </p>
                </div>
            </div>
            <div class="tbody-documents">
                <div class="tbody-doc-left">
                    <h3>Sed ut perspiciatis</h3>
                    <p>
                        Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                        aut fugit, sed quia consequuntur magni dolores eos qui ratione
                        voluptatem sequi nesciunt. Neque porro quisquam est.
                    </p>
                    <p class="author">Oliver Smith - 6 Jan, 2020</p>
                </div>
                <div class="tbody-doc-right">
                    <p><i class="bi bi-calendar2-week"></i> 22-01-22 to 22-01-22</p>
                    <button class="btn btn-outline-success">Download</button>
                    <button class="btn btn-outline-secondary"><a href="./detail.html">See More</a></button>
                    <p class="view">
                        <i class="bi bi-tag"></i> Book &emsp;&emsp;&emsp;&nbsp;
                        <i class="bi bi-people-fill"></i> 2300
                    </p>
                </div>
            </div>
            <div class="page-navigation">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
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

</html>