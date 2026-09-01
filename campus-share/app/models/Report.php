<?php
require_once __DIR__ . '/../config/database.php';

class Report {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function create($userId, $reason) {
        $sql = "INSERT INTO `report` (`user_id`, `reason`, `status`) 
                VALUES (:uid, :reason, 'pending')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':uid' => $userId,
            ':reason' => $reason
        ]);
    }