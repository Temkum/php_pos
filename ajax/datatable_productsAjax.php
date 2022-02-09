<?php

require_once "../controllers/ProductsController.php";
require_once "../models/ProductModel.php";

require_once "../controllers/CategoriesController.php";
require_once "../models/CategoryModel.php";


class ProductsTable
{
    public function showProductsTable()
    {
        $item = null;
        $value = null;
        $products = ProductsController::show($item, $value);

        $jsonData = '{
          "data":[';
          
        for ($i = 0; $i < count($products); $i++) {
            // import img
            $image = "<img src='".$products[$i]["image"]."' alt='Product image' width='50'>";

            // import category
            $item = "id";
            $value = $products[$i]["category_id"];
            $categories = CategoriesController::display($item, $value);

            // import stock
            if ($products[$i]["stock"] <= 10) {
                $stock = "<button class='btn btn-danger'>".$products[$i]["stock"]."</button>";
            } elseif ($products[$i]["stock"] > 11 && $products[$i]["stock"] <= 15) {
                $stock = "<button class='btn btn-warning'>".$products[$i]["stock"]."</button>";
            } else {
                $stock = "<button class='btn btn-success'>".$products[$i]["stock"]."</button>";
            }

            // action btns
            $buttons = "<button class='btn btn-warning btn-sm editProd-btn' data-toggle='modal' data-target='#editProduct' productID='".$products[$i]["id"]."'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm delProd-btn' productID='".$products[$i]["id"]."' code='".$products[$i]["code"]."' image='".$products[$i]["image"]."'><i class='fa fa-trash'></i></button>";

            // show data from db
            $jsonData .='[
						"'.($i+1).'",
						"'.$products[$i]["code"].'",
						"'.$categories["category_name"].'",
						"'.$products[$i]["description"].'",
						"'.$image.'",
						"'.$stock.'",
						"$'.$products[$i]["sale_price"].'",
						"$'.$products[$i]["buying_price"].'",
						"'.$products[$i]["created_at"].'",
						"'.$buttons.'"
            ],';
        }

        $jsonData = substr($jsonData, 0, -1);
        $jsonData .= ']
        }';

        echo $jsonData;
    }
}

// activate products table obj
$activate_prod = new ProductsTable();
$activate_prod->showProductsTable();