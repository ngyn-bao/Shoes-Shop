<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    private $model;

    public function __construct($conn) {
        $this->model = new Product($conn);
    }

    public function getAllProducts() {
        return $this->model->getAll();
    }

    public function getProductById($id) {
        return $this->model->getById($id);
    }
}