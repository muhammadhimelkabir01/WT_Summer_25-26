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