<?php

class CategoriesController
{
  
  /* Add categories */
    public static function store()
    {
        if (isset($_POST['new_category'])) {
            if (preg_match('/^[a-zA-Z0-9_ ]+$/', $_POST['new_category'])) {
                $table = 'categories';
                $data = $_POST['new_category'];

                $response = CategoryModel::addCategory($table, $data);
                if ($response == 'OK') {
                    echo '<script>
                      Swal.fire({
                        icon: "success",
                        title: "Category added successfully!",
                        confirmButtonText: "Close"					
                        }).then((result)=>{
                          if(result.value){
                            window.location = "categories";
                          }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                      Swal.fire({
                        icon: "error",
                        title: "No special characters allowed!",
                        timer: 5000						
                        }).then((result)=>{
                          if(result.value){
                            window.location = "categories";
                          }
                        });
                    </script>';
            }
        }
    }

    /* Load categories */
    public static function display($item, $value)
    {
        $table = 'categories';
        $response = CategoryModel::loadCategories($table, $item, $value);

        return $response;
    }

    /* Update category */
    public static function update()
    {
        if (isset($_POST["editCategory"])) {
            if (preg_match('/^[a-zA-Z0-9_ ]+$/', $_POST["editCategory"])) {
                $table = "categories";

                $data = ['category_name' => $_POST["editCategory"], 'id' => $_POST['idCat']];

                $response = CategoryModel::updateCategories($table, $data);
                // var_dump($response);

                if ($response == "OK") {
                    echo'<script>
                            Swal.fire({
                                icon: "success",
                                title: "Category has been successfully saved!",
                                showConfirmButton: true,
                                confirmButtonText: "Close"
                                }).then(function(result){
                                    if (result.value) {
                                    window.location = "categories";
                                    }
                                })
                          </script>';
                }
            } else {
                echo'<script>
                        Swal.fire({
                            icon: "error",
                            title: "No especial characters or blank fields",
                            showConfirmButton: true,
                            confirmButtonText: "Close"
                            }).then(function(result){
                            if (result.value) {
                            window.location = "categories";
                            }
                          })
                        </script>';
            }
        }
    }

    /* Delete category */
    public static function destroy()
    {
        if (isset($_GET["categoryId"])) {
            $table ="categories";
            $data = $_GET["categoryId"];

            $response = CategoryModel::deleteCategory($table, $data);
            // var_dump($response);

            if ($response == "OK") {
                echo'<script>
                  Swal.fire({
                      icon: "success",
                      title: "The category has been successfully deleted",
                      showConfirmButton: true,
                      confirmButtonText: "Close",
                      }).then(function(result){
                          if (result.value) {
                          window.location = "categories";
                          }
                        })
                    </script>';
            }
        }
    }
}