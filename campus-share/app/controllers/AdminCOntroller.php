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

    public function dashboard() {
        $totalUsers = $this->db->query("SELECT COUNT(*) FROM `user` WHERE `role` != 'admin'")->fetchColumn();
        $totalResources = $this->db->query("SELECT COUNT(*) FROM `resource`")->fetchColumn();
        $totalRentals = $this->db->query("SELECT COUNT(*) FROM `rental_request`")->fetchColumn();
        $totalVolume = $this->db->query("SELECT IFNULL(SUM(amount), 0) FROM `payment` WHERE `payment_status` = 'completed'")->fetchColumn();

        $users = $this->db->query("SELECT * FROM `user` WHERE `role` != 'admin' ORDER BY `created_at` DESC")->fetchAll();
        $categories = $this->db->query("SELECT c.*, (SELECT COUNT(*) FROM `resource` r WHERE r.category_id = c.category_id) as total_items FROM `category` c")->fetchAll();

        require_once __DIR__ . '/../views/admin/dashboard.php';
    }