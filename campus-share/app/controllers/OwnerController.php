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

    public function addResource() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $categoryId = $_POST['category_id'] ?? '';
            $description = trim($_POST['description'] ?? '');
            $itemCondition = $_POST['item_condition'] ?? 'used';
            $sharingType = $_POST['sharing_type'] ?? 'rent';
            $dailyRate = ($sharingType === 'rent') ? floatval($_POST['daily_rate'] ?? 0) : 0.00;
            $securityDeposit = ($sharingType === 'rent') ? floatval($_POST['security_deposit'] ?? 0) : 0.00;

             if (!empty($title) && !empty($categoryId)) {
                $this->resourceModel->create(
                    $_SESSION['user_id'],
                    $categoryId,
                    $title,
                    $description,
                    $itemCondition,
                    $sharingType,
                    $dailyRate,
                    $securityDeposit
                );
                header("Location: index.php?route=owner/dashboard&success=1");
                exit;
            }
        }
    }