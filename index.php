<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>My super blog</title>

    <link rel="stylesheet" href="style.css">
    <style type="text/css">
        #carouselExampleIndicators {
        }
    </style>
</head>
<body>


<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="#" class="navbar-brand">
        <img src="https://i.pinimg.com/originals/9d/16/87/9d1687fe53247d0da876e4bff2e3ce64.png" width="30" height="30"
             alt="logo">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#aboutModal">About us</a>
            </li>

        </ul>


        <form class="form-inline  my-2 my-sm-0">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">Log in</a>
            <a href="#" class="nav-link">Registration</a>
        </form>

    </div>


</nav>

<!--    fade - animation ,
 The tabindex attribute can control the order in which the Tab key moves through the HTML page, overriding the default order.
 The aria-labelledby attribute establishes relationships between objects and their label(s), and its value should be one or more element IDs, which refer to elements that have the text needed for labeling. List multiple element IDs in a space delimited fashion.-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form>
                        <div class="form-group">
                            <label for="inputEmail">Email adress</label>
                            <input type="email" class="form-control" id="inputEmail" aria-labelledby="emailHelp"
                                   placeholder="Email" required>
                            <small id="emailHelp" class="form-text text-muted">Enter your Email</small>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" id="inputPassword"
                                   aria-labelledby="passwordHelp" placeholder="Password" required>
                            <small id="passwordHelp" class="form-text text-muted">Your password has to contain 10
                                simbols
                            </small>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutModalLabel">About us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>This is my first website. Leave comment about it below.</p>
                <form method="POST" action="/leaveComment.php">

                    <div id="messagebox">
                        <p id="headings"><textarea name="comment" rows="3" cols="25"
                                                   placeholder="Insert your message here"></textarea></p>
                        <p id="button"><input class="btn btn-primary" type="submit" value="post" id="innerbutton"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<hr>


<!--PHP GOES HERE-->
<?php
require_once('BlogController.php');
require_once('UserController.php');


if (isset($_GET['page'])) {
    $pageGetVariable = $_GET['page'];
    $pageArray = explode('/', $pageGetVariable);
    $controllerUserFriendlyName = $pageArray[0];
    $functionUserFriendlyNameName = $pageArray[1];

    $routes = ['blog' => [
        'internalControllerName' => 'BlogController',
        'functions' => [
            'index' => 'index',
            'delete' => 'delete',
            'edit' => 'edit',
            'read' => 'read',
            'insert' => 'insert'
        ]
    ],
        'user' => [
            'internalControllerName=>UserController',
            'functions' => [
                'login' => 'login',
                'registration' => 'registration'
            ]
        ]
    ];

    $controllerArrayWithFunctions = $routes[$controllerUserFriendlyName];
    $controllerName = $controllerArrayWithFunctions['internalControllerName'];
    $functionName = $controllerArrayWithFunctions['functions'][$controllerArrayWithFunctions];

    $controller = new $controllerName();
    $controller->$functionName();
} else {
    $defaultPage = 'index';
    $blogController = new BlogController();
    $blogController->$defaultPage();
}


//if($pageName === 'index'){
//    $blogController->index();
//} elseif($pageName === 'edit'){
//    $blogController->edit();
//} elseif($pageName === 'create'){
//    $blogController->create();
//}
//
//if(in_array($pageName,['index','edit','create'])){
//    $blogController->$pageName();
//}

//$arr = [
//        'index' => 'index',
//        'create' => 'create',
//        'edit' => 'edit',
//];
//
//$blogController->$arr[$pageName]();
?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>


