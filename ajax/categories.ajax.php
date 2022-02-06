<?php
require_once "../controllers/CategoriesController.php";
require_once "../models/CategoryModel.php";

class AjaxCategories
{
    /* edit categories */
    public $category_id;

    public function ajaxEditCategory()
    {
        $item = 'id';
        $value = $this->category_id;

        $response = CategoriesController::display($item, $value);

        echo json_encode($response);
    }
}

// edit category object
if (isset($_POST['category_id'])) {
    $edit = new AjaxCategories();
    $edit->category_id = $_POST['category_id'];
    $edit->ajaxEditCategory();
}