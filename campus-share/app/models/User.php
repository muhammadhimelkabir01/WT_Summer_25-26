<?php

require_once __DIR__ . '/../config/database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findByEmail($identifier) {
        $stmt = $this->db->prepare("SELECT * FROM `user` WHERE `email` = :email OR `student_id` = :sid LIMIT 1");
        $stmt->execute([
            ':email' => $identifier,
            ':sid'   => $identifier
        ]);
        return $stmt->fetch();
    }