<?php
require_once __DIR__ . '/../config/database.php';

class RentalRequest {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function create($userId, $resourceId, $startDate, $endDate, $totalRent, $securityDeposit) {
        $sql = "INSERT INTO `rental_request` (`user_id`, `resource_id`, `start_date`, `end_date`, `total_rent`, `security_deposit`, `status`) 
                VALUES (:user_id, :resource_id, :start_date, :end_date, :total_rent, :security_deposit, 'pending')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId,
            ':resource_id' => $resourceId,
            ':start_date' => $startDate,
            ':end_date' => $endDate,
            ':total_rent' => $totalRent,
            ':security_deposit' => $securityDeposit
        ]);
        return $this->db->lastInsertId();
    }