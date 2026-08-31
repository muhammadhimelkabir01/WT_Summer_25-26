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