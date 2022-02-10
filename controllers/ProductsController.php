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
            preg_match('/^[0-9.]+$/', $_POST['new_buyingprice']) &&
            preg_match('/^[0-9.]+$/', $_POST['new_saleprice'])) {
            
                /* validate img upload */
                $photo = "views/img/avatar.jpg";

                if (isset($_FILES["new_photo"]["tmp_name"])) {
                    list($width, $height) = getimagesize($_FILES["new_photo"]["tmp_name"]);

                    $new_height = 500;
                    $new_width = 500;

                    // create folder for each user
                    $folder = "views/img/products/";

                    if (!file_exists($folder)) {
                        mkdir($folder, 0777);
                    }

                    if ($_FILES["new_photo"]["type"] == "image/png") {
                        $randomNumber = mt_rand(100, 999);
                        $img_name = $_POST["new_code"] . $randomNumber;
                        
                        $photo = "views/img/products/". $img_name .".png";
                        
                        $srcImage = imagecreatefrompng($_FILES["new_photo"]["tmp_name"]);
                        
                        $destination = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagepng($destination, $photo);
                    } elseif ($_FILES["new_photo"]["type"] == "image/jpeg") {
                        $randomNumber = mt_rand(100, 999);
                        $img_name = $_POST["new_code"] . $randomNumber;
                        
                        $photo = "views/img/products/". $img_name .".jpg";
                        
                        $srcImage = imagecreatefromjpeg($_FILES["new_photo"]["tmp_name"]);
                        
                        $destination = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagejpeg($destination, $photo);
                    }
                }

                $table = 'products';
                
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

    public static function modify()
    {
        if (isset($_POST['edit_desc'])) {
            if (preg_match('/^[a-zA-Z0-9_ ]+$/', $_POST['edit_desc']) &&
            preg_match('/^[0-9]+$/', $_POST['edit_stock']) &&
            preg_match('/^[0-9.]+$/', $_POST['edit_buyingprice']) &&
            preg_match('/^[0-9.]+$/', $_POST['edit_saleprice'])) {
            
                /* validate img upload */
                $photo = $_POST["old_image"];

                if (isset($_FILES["edit_photo"]["tmp_name"])) {
                    list($width, $height) = getimagesize($_FILES["edit_photo"]["tmp_name"]);

                    $new_height = 500;
                    $new_width = 500;

                    // create folder for each user
                    $folder = "views/img/products/";

                    if (!empty($_POST["old_image"])) {
                        unlink($_POST["old_image"]);
                    } else {
                        mkdir($folder, 0777);
                    }

                    if ($_FILES["edit_photo"]["type"] == "image/png") {
                        $randomNumber = mt_rand(100, 999);
                        $img_name = $_POST["edit_code"] . $randomNumber;
                        
                        $photo = "views/img/products/". $img_name .".png";
                        
                        $srcImage = imagecreatefrompng($_FILES["edit_photo"]["tmp_name"]);
                        
                        $destination = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagepng($destination, $photo);
                    } elseif ($_FILES["edit_photo"]["type"] == "image/jpeg") {
                        $randomNumber = mt_rand(100, 999);
                        $img_name = $_POST["edit_code"] . $randomNumber;
                        
                        $photo = "views/img/products/". $img_name .".jpg";
                        
                        $srcImage = imagecreatefromjpeg($_FILES["edit_photo"]["tmp_name"]);
                        
                        $destination = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagejpeg($destination, $photo);
                    }
                }

                $table = 'products';
                
                $data = array('category_id' => $_POST['edit_category'],
                'stock' => $_POST['edit_stock'],
                'buying_price' => $_POST['edit_buyingprice'],
                'sale_price' => $_POST['edit_saleprice'],
                'description' => $_POST['edit_desc'],
                'code' => $_POST['edit_code'],
                'image' => $photo);

                $response = ProductModel::modifyProduct($table, $data);
                if ($response == 'OK') {
                    echo '<script>
                      Swal.fire({
                        icon: "success",
                        title: "Product updated successfully!",
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
                        title: "Update failed! Please check input fields!",
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