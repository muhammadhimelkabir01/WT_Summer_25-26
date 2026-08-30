<?php
require_once __DIR__ . '/../models/RentalRequest.php';
require_once __DIR__ . '/../models/DonationRequest.php';
require_once __DIR__ . '/../models/Payment.php';

class StudentController {
    private $rentalModel;
    private $donationModel;
    private $paymentModel;

    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
            header("Location: index.php?route=login");
            exit;
        }
        $this->rentalModel = new RentalRequest();
        $this->donationModel = new DonationRequest();
        $this->paymentModel = new Payment();
    }

    public function dashboard() {
        $rentals = $this->rentalModel->getByStudentId($_SESSION['user_id']);
        $donations = $this->donationModel->getByStudentId($_SESSION['user_id']);
        require_once __DIR__ . '/../views/student/dashboard.php';
    }

    public function requestRent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resourceId = $_POST['resource_id'];
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];
            $dailyRate = floatval($_POST['daily_rate']);
            $deposit = floatval($_POST['security_deposit']);

            $d1 = new DateTime($startDate);
            $d2 = new DateTime($endDate);
            $days = $d2->diff($d1)->days + 1;
            $totalRent = $days * $dailyRate;

            $rentalId = $this->rentalModel->create(
                $_SESSION['user_id'],
                $resourceId,
                $startDate,
                $endDate,
                $totalRent,
                $deposit
            );

            header("Location: index.php?route=student/checkout&rental_id=" . $rentalId);
            exit;
        }
    }

    public function showCheckout() {
        $rentalId = $_GET['rental_id'] ?? null;
        if (!$rentalId) {
            header("Location: index.php?route=student/dashboard");
            exit;
        }
        $rental = $this->rentalModel->getById($rentalId);
        if (!$rental) {
            header("Location: index.php?route=student/dashboard");
            exit;
        }
        require_once __DIR__ . '/../views/student/checkout.php';
    }

    public function processPayment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rentalId = $_POST['rental_id'];
            $method = $_POST['method'];
            $amount = floatval($_POST['amount']);

            $txnId = $this->paymentModel->createSimulatedPayment($rentalId, $method, $amount);
            header("Location: index.php?route=student/dashboard&paid=1&txnid=" . $txnId);
            exit;
        }
    }