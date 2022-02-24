<?php

class SalesController
{
    public static function display($item, $value)
    {
        $table = 'sales';
        $response = SaleModel::loadSales($table,$item,$value);

        return $response;
    }

    static public function store()
    {
        if (isset($_POST['sale_vendor'])) {
            $productsList = json_decode($_POST["products_list"], true);
            
            $totalPurchasedProducts = [];
            
            foreach ($productsList as $key => $value) {

			   array_push($totalPurchasedProducts, $value["quantity"]);
				
			   $prods_table = "products";

			    $item = "id";
			    $product_id_value = $value["id"];
			    $order = "id";

			    $get_product = ProductModel::showProducts($prods_table, $item, $product_id_value, $order);

				$item1_a = "sales";
				$value1_a = $value["quantity"] + $get_product["sales"];

			    $new_sales = ProductModel::updateProduct($prods_table, $item1_a, $value1_a, $product_id_value);

				$item1_b = "stock";
				$value1_b = $value["stock"];

				$new_stock = ProductModel::updateProduct($prods_table, $item1_b, $value1_b, $product_id_value);
			}

            $clients_table = "clients";

			$item = "id";
			$valueCustomer = $_POST["select_client"];

			$getCustomer = ClientModel::loadClients($clients_table, $item, $valueCustomer);

			$item1a = "purchases";
			$value1a = array_sum($totalPurchasedProducts) + $getCustomer["purchases"];

			$customerPurchases = ClientModel::updateClient($clients_table, $item1a, $value1a, $valueCustomer);

			$item1b = "last_login";

			// date_default_timezone_set('America/Bogota');

			$date = date('Y-m-d');
			$hour = date('H:i:s');
			$value1b = $date.' '.$hour;

			$dateCustomer = ClientModel::modifyClient($clients_table, $item1b, $value1b, $valueCustomer);

            // Save the sale
            $table = "sales";

			$data = array(                      
                        "code" => $_POST['sale_vendor'],
                        "client_id" => $_POST['select_client'],
                        "vendor_id" => $_POST['vendor_id'],
                        "product" => $_POST['products_list'],
                        "tax" => $_POST['new_tax_price'],
                        "net_price" => $_POST['new_net_price'],
                        "total" => $_POST['total_sale'],
                        "payment_method" => $_POST['new_payment_method']
                        );

			$response = SaleModel::addSale($table, $data); 
              
            if($response == "OK"){

				echo'<script>

                    localStorage.removeItem("range");

                    Swal.fire({
                        icon: "success",
                        title: "The added successfully!",
                        showConfirmButton: true,
                        confirmButtonText: "Close"
                        }).then((result) => {
                                    if (result.value) {
                                    window.location = "sales";
                                    }
                                })
                </script>';
			}         
        }
    }
}