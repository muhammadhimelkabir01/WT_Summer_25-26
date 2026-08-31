<?php
// app/models/Resource.php
require_once __DIR__ . '/../config/database.php';

class Resource {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAllCategories() {
        $stmt = $this->db->query("SELECT * FROM `category` ORDER BY `category_name` ASC");
        return $stmt->fetchAll();
    }

     public function searchAndFilter($keyword = '', $categoryId = '', $sharingType = '') {
        $sql = "SELECT r.*, c.category_name, u.full_name as owner_name 
                FROM `resource` r
                JOIN `category` c ON r.category_id = c.category_id
                JOIN `user` u ON r.user_id = u.user_id
                WHERE r.is_available = 1";
        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND (r.title LIKE :kw OR r.description LIKE :kw)";
            $params[':kw'] = "%$keyword%";
        }
        if (!empty($categoryId)) {
            $sql .= " AND r.category_id = :cat_id";
            $params[':cat_id'] = $categoryId;

             }
        if (!empty($sharingType)) {
            $sql .= " AND r.sharing_type = :sharing_type";
            $params[':sharing_type'] = $sharingType;
        }

        $sql .= " ORDER BY r.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT r.*, c.category_name, u.full_name as owner_name, u.email as owner_email 
        FROM `resource` r
                JOIN `category` c ON r.category_id = c.category_id
                JOIN `user` u ON r.user_id = u.user_id
                WHERE r.resource_id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getByOwnerId($ownerId) {
        $sql = "SELECT r.*, c.category_name 
                FROM `resource` r
                JOIN `category` c ON r.category_id = c.category_id
                WHERE r.user_id = :owner_id
                ORDER BY r.created_at DESC";
                $stmt = $this->db->prepare($sql);
        $stmt->execute([':owner_id' => $ownerId]);
        return $stmt->fetchAll();
    }

    public function create($userId, $categoryId, $title, $description, $itemCondition, $sharingType, $dailyRate, $securityDeposit) {
        $sql = "INSERT INTO `resource` (`user_id`, `category_id`, `title`, `description`, `item_condition`, `sharing_type`, `daily_rate`, `security_deposit`, `is_available`) 
                VALUES (:user_id, :category_id, :title, :description, :item_condition, :sharing_type, :daily_rate, :security_deposit, 1)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':category_id' => $categoryId,
            ':title' => $title,
            ':description' => $description,
            ':item_condition' => $itemCondition,
            ':sharing_type' => $sharingType,
            ':daily_rate' => $dailyRate,
            ':security_deposit' => $securityDeposit
        ]);
    }

    public function delete($resourceId, $ownerId) {
        $stmt = $this->db->prepare("DELETE FROM `resource` WHERE `resource_id` = :id AND `user_id` = :owner_id");
        return $stmt->execute([':id' => $resourceId, ':owner_id' => $ownerId]);
    }
}