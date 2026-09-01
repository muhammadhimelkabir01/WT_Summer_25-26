<?php

require_once __DIR__ . '/../config/database.php';

class Review {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function create($userId, $resourceId, $rating, $comment) {
        $sql = "INSERT INTO `review` (`user_id`, `resource_id`, `rating`, `comment`) 
                VALUES (:uid, :rid, :rating, :comment)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':uid' => $userId,
            ':rid' => $resourceId,
            ':rating' => $rating,
            ':comment' => $comment
        ]);
    }
}