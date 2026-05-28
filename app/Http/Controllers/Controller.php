<?php
require_once('SecurityController.php');

$controller = new SecurityController();

$action = $_GET['action'];

switch ($action) {

    case 'delete-user':
        $controller->deleteUser();
        break;

    case 'login':
        $controller->login();
        break;

    case 'verify-otp':
        $controller->verifyOTP();
        break;

    case 'logout':
        $controller->logout();
        break;

    default:
        echo "Action tidak ditemukan!";
}
?>