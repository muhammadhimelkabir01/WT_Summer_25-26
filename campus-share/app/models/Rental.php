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

    public function getById($rentalId) {
        $sql = "SELECT rr.*, r.title, (rr.total_rent + rr.security_deposit) as payable_amount 
                FROM `rental_request` rr
                JOIN `resource` r ON rr.resource_id = r.resource_id
                WHERE rr.rental_id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $rentalId]);
        return $stmt->fetch();
    }

    public function getByStudentId($studentId) {
        $sql = "SELECT rr.*, r.title, r.item_condition, u.full_name as owner_name, u.email as owner_email, p.payment_status, p.transaction_id
                FROM `rental_request` rr
                JOIN `resource` r ON rr.resource_id = r.resource_id
                JOIN `user` u ON r.user_id = u.user_id
                LEFT JOIN `payment` p ON rr.rental_id = p.rental_id
                WHERE rr.user_id = :student_id
                ORDER BY rr.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':student_id' => $studentId]);
        return $stmt->fetchAll();
    }