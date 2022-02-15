<?php

require_once "../controllers/ProductsController.php";
require_once "../models/ProductModel.php";

class SalesTable
{
    public function loadProductSales()
    {
        $item = null;
        $value = null;
        $products = ProductsController::show($item, $value);

        $jsonData = '{
          "data":[';
          
        for ($i = 0; $i < count($products); $i++) {
            // import img
            $image = "<img src='".$products[$i]["image"]."' alt='Product image' width='50'>";

            // import stock
            if ($products[$i]["stock"] <= 10) {
                $stock = "<button class='btn btn-danger'>".$products[$i]["stock"]."</button>";
            } elseif ($products[$i]["stock"] > 11 && $products[$i]["stock"] <= 15) {
                $stock = "<button class='btn btn-warning'>".$products[$i]["stock"]."</button>";
            } else {
                $stock = "<button class='btn btn-success'>".$products[$i]["stock"]."</button>";
            }

            // action btns
            $buttons = "<button class='btn btn-primary btn-sm add-product recover-btn' productID='".$products[$i]["id"]."'>Add</button>";

            // show data from db
            $jsonData .='[
						"'.($i+1).'",
						"'.$products[$i]["code"].'",
						"'.$products[$i]["description"].'",
						"'.$image.'",
						"'.$stock.'",
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
$activate_sale = new SalesTable();
$activate_sale->loadProductSales();