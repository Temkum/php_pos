<?php

require_once '../controllers/ProductsController.php';
require_once '../models/ProductModel.php';

class AjaxProducts
{
    public $categoryId;

    public function ajaxProductCode()
    {
        $item = 'category_id';
        $value = $this->categoryId;
        $response = ProductsController::show($item, $value);
        echo json_encode($response);
    }

    public $product_id;
    public $load_products;
    public $product_name;

    // edit product
    public function ajaxProductEdit()
    {
        if ($this->load_products == 'OK') {
            $item = null;
            $value = null;
            $response = ProductsController::show($item, $value);
    
            echo json_encode($response);
        } elseif ($this->product_name != '') {
            $item = 'description';
            $value = $this->product_name;
            $response = ProductsController::show($item, $value);
        
            echo json_encode($response);
        } else {
            $item = 'id';
            $value = $this->product_id;
            $response = ProductsController::show($item, $value);
        
            echo json_encode($response);
        }
    }
}

// generate code from category id
if (isset($_POST['categoryId'])) {
    # code...
    $prod_code = new AjaxProducts();
    $prod_code->categoryId = $_POST['categoryId'];
    $prod_code->ajaxProductCode();
}

// edit prod object
if (isset($_POST['productId'])) {
    $edit = new AjaxProducts();
    $edit->product_id = $_POST['productId'];
    $edit->ajaxProductEdit();
}

// Load products
if (isset($_POST['load_products'])) {
    $load_products = new AjaxProducts();
    $load_products->load_products = $_POST['load_products'];
    $load_products->ajaxProductEdit();
}

// Get product name
if (isset($_POST['load_products'])) {
    $load_products = new AjaxProducts();
    $load_products->product_name = $_POST['load_products'];
    $load_products->ajaxProductEdit();
}