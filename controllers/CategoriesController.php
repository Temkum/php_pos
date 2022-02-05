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
                        timer: 1500						
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
}