<?php

class SaleModel
{
    public static function loadSales($table, $item, $value)
    {
        // check if data exist
        if ($item != null) {
            // get single sale
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id DESC");

            $stmt->bindParam(":". $item, $value, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
        } else {
            // get all sales
            $stmt=Connection::connect()->prepare("SELECT * FROM $table");
            $stmt->execute();
            
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }

    static public function addSale($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(code, client_id, vendor_id, product, tax, net_price, total, payment_method) VALUES (:code, :client_id, :vendor_id, :product, :tax, :net_price, :total, :payment_method)");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":client_id", $data["client_id"], PDO::PARAM_INT);
		$stmt->bindParam(":vendor_id", $data["vendor_id"], PDO::PARAM_INT);
		$stmt->bindParam(":product", $data["product"], PDO::PARAM_STR);
		$stmt->bindParam(":tax", $data["tax"], PDO::PARAM_STR);
		$stmt->bindParam(":net_price", $data["net_price"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $data["total"], PDO::PARAM_STR);
		$stmt->bindParam(":payment_method", $data["payment_method"], PDO::PARAM_STR);

		if($stmt -> execute()){
			return "OK";
		}else{
			return "error";	
		}        
		$stmt->close();
		$stmt = null;
	}
}