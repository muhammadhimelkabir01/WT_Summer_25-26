<?php
// app/controllers/OwnerController.php
require_once __DIR__ . '/../models/Resource.php';
require_once __DIR__ . '/../models/RentalRequest.php';

class OwnerController {
    private $resourceModel;
    private $rentalModel;
