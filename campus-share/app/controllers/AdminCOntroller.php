<?php

require_once __DIR__ . '/../config/database.php';

class AdminController {
    private $db;

    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?route=login");
            exit;
        }
        $this->db = Database::getConnection();
    }