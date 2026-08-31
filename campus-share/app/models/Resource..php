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