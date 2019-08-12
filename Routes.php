<?php
require_once('BlogController.php');
require_once('UserController.php');


if (isset($_GET['page'])) {
    var_dump($_GET);
    $pageGetVariable = $_GET['page'];
    $pageArray = explode('/', $pageGetVariable);
    $controllerUserFriendlyName = $pageArray[0];
    $functionUserFriendlyName = $pageArray[1];

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
    $functionName = $controllerArrayWithFunctions['functions'][$functionUserFriendlyName];


    $controller = new $controllerName();
    $controller->$functionName();
} else {
    $defaultPage = 'index';
    $blogController = new BlogController();
    $blogController->$defaultPage();
}
