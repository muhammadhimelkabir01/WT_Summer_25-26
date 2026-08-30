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