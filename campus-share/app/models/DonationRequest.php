<?php

require_once __DIR__ . '/../config/database.php';

class DonationRequest {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function create($userId, $resourceId, $message) {
        $sql = "INSERT INTO `donation_request` (`user_id`, `resource_id`, `request_message`, `status`) 
                VALUES (:user_id, :resource_id, :msg, 'pending')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':resource_id' => $resourceId,
            ':msg' => $message
        ]);
    }

    public function getByStudentId($studentId) {
        $sql = "SELECT dr.*, r.title, u.full_name as owner_name
                FROM `donation_request` dr
                JOIN `resource` r ON dr.resource_id = r.resource_id
                JOIN `user` u ON r.user_id = u.user_id
                WHERE dr.user_id = :student_id
                ORDER BY dr.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':student_id' => $studentId]);
        return $stmt->fetchAll();
    }
}