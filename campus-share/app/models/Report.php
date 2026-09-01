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

    public function getAll() {
        $sql = "SELECT r.*, u.full_name, u.email, u.student_id 
                FROM `report` r 
                JOIN `user` u ON r.user_id = u.user_id 
                ORDER BY r.created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function updateStatus($reportId, $status) {
        $stmt = $this->db->prepare("UPDATE `report` SET `status` = :status WHERE `report_id` = :id");
        return $stmt->execute([':status' => $status, ':id' => $reportId]);
    }
}