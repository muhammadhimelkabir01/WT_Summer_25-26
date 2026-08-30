<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/OwnerController.php';
require_once __DIR__ . '/../app/controllers/StudentController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';

$route = $_GET['route'] ?? 'home';

$authController = new AuthController();
$homeController = new HomeController();

switch ($route) {
    // Guest & Public Routes
    case 'home':
        $homeController->index();
        break;

    case 'details':
    case 'resource/detail':
        $homeController->details();
        break;

    // Authentication Routes
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->handleLogin();
        } else {
            $authController->showLogin();
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->handleRegister();
        } else {
            $authController->showRegister();
        }
        break;

    case 'logout':
        $authController->logout();
        break;

    // Owner Routes
    case 'owner/dashboard':
        $ownerController = new OwnerController();
        $ownerController->dashboard();
        break;

    case 'owner/add-resource':
    case 'owner/post-item':
        $ownerController = new OwnerController();
        if (method_exists($ownerController, 'postItem')) {
            $ownerController->postItem();
        } else {
            $ownerController->addResource();
        }
        break;

    case 'owner/delete-resource':
    case 'owner/delete-item':
        $ownerController = new OwnerController();
        if (method_exists($ownerController, 'deleteItem')) {
            $ownerController->deleteItem();
        } else {
            $ownerController->deleteResource();
        }
        break;

    case 'owner/update-status':
        $ownerController = new OwnerController();
        $ownerController->updateRentalStatus();
        break;

    // Student Routes
    case 'student/dashboard':
        $studentController = new StudentController();
        $studentController->dashboard();
        break;

    case 'student/rent':
    case 'student/request-rent':
        $studentController = new StudentController();
        $studentController->requestRent();
        break;

    case 'student/donate-claim':
    case 'student/request-donation':
        $studentController = new StudentController();
        $studentController->requestDonation();
        break;

    case 'student/checkout':
        $studentController = new StudentController();
        $studentController->showCheckout();
        break;

    case 'student/process-payment':
        $studentController = new StudentController();
        $studentController->processPayment();
        break;

    case 'student/cancel-rent':
    case 'student/cancel-rental':
        $studentController = new StudentController();
        $studentController->cancelRental();
        break;

    // Admin Routes
    case 'admin/dashboard':
        $adminController = new AdminController();
        $adminController->dashboard();
        break;

    case 'admin/update-user':
        $adminController = new AdminController();
        $adminController->updateUserStatus();
        break;

    case 'admin/add-category':
        $adminController = new AdminController();
        $adminController->addCategory();
        break;

    default:
        $homeController->index();
        break;
}