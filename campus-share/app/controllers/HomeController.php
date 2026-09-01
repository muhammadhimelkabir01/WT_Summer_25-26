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
    public function details() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?route=home");
            exit;
        }
        $resource = $this->resourceModel->getById($id);
        if (!$resource) {
            echo "Resource not found.";
            return;
        }
        require_once __DIR__ . '/../views/guest/resource-details.php';
    }
}