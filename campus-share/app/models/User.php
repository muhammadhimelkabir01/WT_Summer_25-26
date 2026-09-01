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

    public function register($fullName, $email, $studentId, $password, $role = 'student') {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO `user` (`full_name`, `email`, `student_id`, `password`, `role`, `is_verified`, `status`) 
                                    VALUES (:full_name, :email, :student_id, :password, :role, 0, 'active')");
        return $stmt->execute([
            ':full_name'  => $fullName,
            ':email'       => $email,
            ':student_id'  => $studentId,
            ':password'    => $hash,
            ':role'        => $role
        ]);
    }
}