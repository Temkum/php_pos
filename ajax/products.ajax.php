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
}

// generate code from category id
if (isset($_POST['categoryId'])) {
    # code...
    $prod_code = new AjaxProducts();
    $prod_code->categoryId = $_POST['categoryId'];
    $prod_code->ajaxProductCode();
}