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

     public function deleteResource() {
        $resourceId = $_GET['id'] ?? null;
        if ($resourceId) {
            $this->resourceModel->delete($resourceId, $_SESSION['user_id']);
            header("Location: index.php?route=owner/dashboard&deleted=1");
            exit;
        }
    }

    public function updateRentalStatus() {
        $rentalId = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;

        if ($rentalId && in_array($status, ['accepted', 'rejected', 'handed_over', 'returned'])) {
            $this->rentalModel->updateStatus($rentalId, $status);
            header("Location: index.php?route=owner/dashboard&status_updated=1");
            exit;
        }
    }
}