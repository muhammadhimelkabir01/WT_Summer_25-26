<?php

require_once __DIR__ . '/../models/Resource.php';

class HomeController {
    private $resourceModel;

    public function __construct() {
        $this->resourceModel = new Resource();
    }

    public function index() {
        $keyword = trim($_GET['search'] ?? '');
        $category = $_GET['category'] ?? '';
        $type = $_GET['type'] ?? '';

        $categories = $this->resourceModel->getAllCategories();
        $resources = $this->resourceModel->searchAndFilter($keyword, $category, $type);

        require_once __DIR__ . '/../views/guest/home.php';
    }