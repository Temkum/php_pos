<?php
class ClientsController
{
    public static function store()
    {
        if (isset($_POST['new_name'])) {
            if (preg_match('/^[a-zA-Z0-9_ ]+$/', $_POST['new_name']) &&
            preg_match('/^[0-9]+$/', $_POST['new_docid']) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['new_email']) &&
            preg_match('/^[()\-0-9 ]+$/', $_POST['new_phone'])  &&
            preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["new_address"])) {
                $table = 'clients';
          
                $data = array('name'=>$_POST['new_name'],
                'document_id'=>$_POST['new_docid'],
                'email'=>$_POST['new_email'],
                'phone'=>$_POST['new_phone'],
                'address'=>$_POST['new_address'] );
                
                $response = ClientModel::addClient($table, $data);
                
                if ($response == 'OK') {
                    echo '<script>
                      Swal.fire({
                        icon: "success",
                        title: "Client added successfully!",
                        confirmButtonText: "Close"					
                        }).then((result)=>{
                          if(result.value){
                            window.location = "clients";
                          }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                      Swal.fire({
                        icon: "error",
                        title: "Fields cannot be black or no special characters allowed!",
                        timer: 5000						
                        }).then((result)=>{
                          if(result.value){
                            window.location = "clients";
                          }
                        });
                    </script>';
            }
        }
    }

    public static function display($item, $value)
    {
        $table = 'clients';
        $response = ClientModel::loadClients($table, $item, $value);

        return $response;
    }
}