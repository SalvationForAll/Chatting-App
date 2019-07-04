<?php
include "controllers/loginController.php";
include "controllers/defaultController.php";

if($_GET['action'] == 'login'){
    $controller = new loginController();
    $controller->login();
} else {
    $controller = new defaultController();
    $controller->error('action-not-found');
}