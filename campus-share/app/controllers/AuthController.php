<?php

require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

     public function showLogin() {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function showRegister() {
        require_once __DIR__ . '/../views/auth/register.php';
    }