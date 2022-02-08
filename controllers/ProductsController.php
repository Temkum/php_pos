<?php

class ProductsController
{
    public static function show($item, $value)
    {
        $table = 'products';
        $response = ProductModel::showProducts($table, $item, $value);

        return $response;
    }

    public static function store()
    {
        if (isset($_POST['new_desc'])) {
            if (preg_match('/^[a-zA-Z0-9_ ]+$/', $_POST['new_desc']) &&
            preg_match('/^[0-9]+$/', $_POST['new_stock']) &&
            preg_match('/^[0-9]+$/', $_POST['new_buyingprice']) &&
            preg_match('/^[0-9]+$/', $_POST['new_saleprice'])) {
                $table = 'products';
                $photo = 'views/img/avatar.jpg';

                $data = ['category_id' => $_POST['new_category'],
                'stock' => $_POST['new_stock'],
                'buying_price' => $_POST['new_buyingprice'],
                'sale_price' => $_POST['new_saleprice'],
                'description' => $_POST['new_desc'],
                'code' => $_POST['new_code'],
                'image' => $photo,
            ];

                $response = ProductModel::addProduct($table, $data);
                if ($response == 'OK') {
                    echo '<script>
                      Swal.fire({
                        icon: "success",
                        title: "Product added successfully!",
                        confirmButtonText: "Close"					
                        }).then((result)=>{
                          if(result.value){
                            window.location = "products";
                          }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                      Swal.fire({
                        icon: "error",
                        title: "No empty fields or special characters allowed!",
                        timer: 5000						
                        }).then((result)=>{
                          if(result.value){
                            window.location = "products";
                          }
                        });
                    </script>';
            }
        }
    }
}