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

    public function updateUserStatus() {
        $userId = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;

        if ($userId && in_array($status, ['active', 'suspended'])) {
            $stmt = $this->db->prepare("UPDATE `user` SET `status` = :status, `is_verified` = 1 WHERE `user_id` = :id");
            $stmt->execute([':status' => $status, ':id' => $userId]);
            header("Location: index.php?route=admin/dashboard&msg=user_updated");
            exit;
        }
    }

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['category_name'] ?? '');
            $desc = trim($_POST['description'] ?? '');

            if (!empty($name)) {
                $stmt = $this->db->prepare("INSERT INTO `category` (`category_name`, `description`) VALUES (:name, :desc)");
                $stmt->execute([':name' => $name, ':desc' => $desc]);
                header("Location: index.php?route=admin/dashboard&msg=cat_added");
                exit;
            }
        }
    }
}