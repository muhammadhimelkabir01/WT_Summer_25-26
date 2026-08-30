<?php
require_once __DIR__ . '/../config/database.php';

class Payment {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function createSimulatedPayment($rentalId, $method, $amount) {
        $txnId = 'TXN-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8)) . '-' . date('Ymd');
        
        // 1. Check if a payment record already exists for this rental
        $stmtCheck = $this->db->prepare("SELECT payment_id FROM `payment` WHERE `rental_id` = :rental_id LIMIT 1");
        $stmtCheck->execute([':rental_id' => $rentalId]);
        $existing = $stmtCheck->fetch();

        if ($existing) {
            $sql = "UPDATE `payment` 
                    SET `payment_method` = :method, 
                        `amount` = :amount, 
                        `payment_status` = 'paid', 
                        `transaction_id` = :txn_id 
                    WHERE `rental_id` = :rental_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':method' => $method,
                ':amount' => $amount,
                ':txn_id' => $txnId,
                ':rental_id' => $rentalId
            ]);
        } else {
            $sql = "INSERT INTO `payment` (`rental_id`, `payment_method`, `amount`, `payment_status`, `transaction_id`) 
                    VALUES (:rental_id, :method, :amount, 'paid', :txn_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':rental_id' => $rentalId,
                ':method' => $method,
                ':amount' => $amount,
                ':txn_id' => $txnId
            ]);
        }

        return $txnId;
    }

    public function getByRentalId($rentalId) {
        $stmt = $this->db->prepare("SELECT * FROM `payment` WHERE `rental_id` = :id LIMIT 1");
        $stmt->execute([':id' => $rentalId]);
        return $stmt->fetch();
    }
}