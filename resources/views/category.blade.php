<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <div class="login-box">
                    <div class="dropdown">
                        <div class="login-infor-user" data-bs-toggle="dropdown">
                            <img src="../img/avatar.png" alt="">
                            <div class="login-infor-user-name">
                                <p>Oliver Smith</p>
                                <h6>Teacher English</h6>
                            </div>
                            <p><i class="bi bi-chevron-down"></i></p>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="./use-detail.html">View Profile</a></li>
                            <li><a class="dropdown-item" href="./create-docs.html">New Docs</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tbody-category">
        <div class="tbody">
            <div class="tbody-sitebar">
                <h4 class="tbody-category-h4">Category</h4>
                <ul>
                    @foreach ($categories as $cate)
                    <li><a href="">{{$cate ->category_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="tbody-content">
                <div class="tbody-detail-category">
                    <p>Category</p>
                    <input class="category-btn-new" type="button" id="new" value="New" />
                </div>
                <form action="{{route('category.store')}}" class="form-add" id="content" method="POST">
                    @csrf
                    <label for="category-name">Category Name :</label>
                    <input class="category-input" type="text" id="cate-name" name="category_name">
                    <button type="submit" class="category-btn-add">Add</button>
                    <input class="category-btn-cancel" type="button" id="cancel" value="Cancel" />
                </form>
                <script language="javascript">
                    document.getElementById("new").onclick = function () {
                        document.getElementById("content").style.display = 'block';
                    };
                    document.getElementById("cancel").onclick = function () {
                        document.getElementById("content").style.display = 'none';
                    };    
                </script>
                <div class="tbody-category">
                    @foreach ($categories as $cate)
                    <div class="category-item">
                        <h3 id="category-item-name">{{$cate ->category_name}}</h3>
                        <form action="{{route('category.update', $cate ->id)}}" method="POST" class="form-edit" id="editItem">
                            @csrf
                            @method("PUT")
                            <input class="category-input" type="text" id="cate-name" name="category_name"
                                value="{{$cate ->category_name}}">
                                <button type="submit" class="category-btn-edit" id="save">Save</button>
                        </form>
                        <div class="category-tool">
                            <input class="category-btn-edit" type="button" id="edit" value="Edit" />
                            
                            <form action="{{route('category.destroy', $cate ->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="category-btn-delete">Delete</button>
                            </form>
                            
                        </div>
                    </div>
                    <script language="javascript">
                        document.getElementById("edit").onclick = function () {
                            document.getElementById("editItem").style.display = 'inline-block';
                            document.getElementById("edit").style.display = 'none';
                            document.getElementById("category-item-name").style.display = 'none';
                            document.getElementById("save").style.display = 'inline-block';
                        };
                        document.getElementById("save").onclick = function () {
                            document.getElementById("editItem").style.display = 'none';
                            document.getElementById("save").style.display = 'none';
                            document.getElementById("category-item-name").style.display = 'inline-block';
                            document.getElementById("edit").style.display = 'inline-block';
                        };    
                    </script>
                    @endforeach
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