<?php

require_once __DIR__ . '/../models/Resource.php';

class HomeController {
    private $resourceModel;

    public function __construct() {
        $this->resourceModel = new Resource();
    }