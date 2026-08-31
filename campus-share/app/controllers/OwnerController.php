<?php
// app/controllers/OwnerController.php
require_once __DIR__ . '/../models/Resource.php';
require_once __DIR__ . '/../models/RentalRequest.php';

class OwnerController {
    private $resourceModel;
    private $rentalModel;

    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
            header("Location: index.php?route=login");
            exit;
        }
        $this->resourceModel = new Resource();
        $this->rentalModel = new RentalRequest();
    }

    public function dashboard() {
        $categories = $this->resourceModel->getAllCategories();
        $myResources = $this->resourceModel->getByOwnerId($_SESSION['user_id']);
        $incomingRentals = $this->rentalModel->getIncomingByOwnerId($_SESSION['user_id']);
        
        require_once __DIR__ . '/../views/owner/dashboard.php';
    }