<?php

require_once 'Connection.php';

class ProductModel
{
    public static function showProducts($table, $item, $value)
    {
        // check if data exist
        if ($item != null) {
            // get single category
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id DESC");

            $stmt->bindParam(":". $item, $value, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
        } else {
            // get all categories
            $stmt=Connection::connect()->prepare("SELECT * FROM $table");
            $stmt->execute();
            
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }

    public static function addProduct($table, $data)
    {
        $query = "INSERT INTO $table(category_id, code, description, image, stock, buying_price, sale_price) VALUES(:category_id, :code, :description, :image, :stock, :buying_price, :sale_price)";
        
        $stmt = Connection::connect()->prepare($query);
        
        $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
        $stmt->bindParam(':code', $data['code'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
        $stmt->bindParam(':stock', $data['stock'], PDO::PARAM_STR);
        $stmt->bindParam(':buying_price', $data['buying_price'], PDO::PARAM_STR);
        $stmt->bindParam(':sale_price', $data['sale_price'], PDO::PARAM_STR);
        // var_dump($data);
        // return;

        if ($stmt->execute()) {
            return 'OK';
        } else {
            return 'error';
        }
        $stmt->close();
        $stmt = null;
    }

    public static function modifyProduct($table, $data)
    {
        $sql = "UPDATE $table SET category_id=:category_id, description=:description, image=:image, stock=:stock, buying_price=:buying_price, sale_price=:sale_price WHERE code=:code";

        $stmt = Connection::connect()->prepare($sql);

        $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
        $stmt->bindParam(':code', $data['code'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
        $stmt->bindParam(':stock', $data['stock'], PDO::PARAM_STR);
        $stmt->bindParam(':buying_price', $data['buying_price'], PDO::PARAM_STR);
        $stmt->bindParam(':sale_price', $data['sale_price'], PDO::PARAM_STR);
        

        if ($stmt->execute()) {
            return "OK";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    public static function deleteProduct($table, $data)
    {
        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

        $stmt -> bindParam(":id", $data, PDO::PARAM_INT);

        if ($stmt -> execute()) {
            return "OK";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function updateProduct($table, $item1, $value1, $value){

		$stmt = Connection::connect()->prepare("UPDATE $table SET $item1 = :item1 WHERE id = :id");

		$stmt->bindParam(":".$item1, $value1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $value, PDO::PARAM_STR);
 
		if($stmt->execute()){
			return "OK";
		}else{
			return "error";	
		}        
		$stmt->close();
		$stmt = null;
	}
}