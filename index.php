
<!--PHP GOES HERE-->
<?php
include('htmlAndCss.php');
require_once('BlogController.php');
require_once('UserController.php');


if (isset($_GET['page'])) {
    var_dump($_GET);
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
            'internalControllerName' => 'UserController',
            'functions' => [
                'login' => 'login',
                'registration' => 'registration'
            ]
        ]
    ];

    $controllerArrayWithFunctions = $routes[$controllerUserFriendlyName];
    $controllerName = $controllerArrayWithFunctions['internalControllerName'];
    $functionName = $controllerArrayWithFunctions['functions'][$functionUserFriendlyNameName];

    $controller = new $controllerName();
    $controller->$functionName();
} else {
    $defaultPage = 'index';
    $blogController = new BlogController();
    $blogController->$defaultPage();
}

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


