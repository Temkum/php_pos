<?php

require_once 'Connection.php';

class ProductModel
{
    public static function showProducts($table, $item, $value)
    {
        // check if data exist
        if ($item != null) {
            // get single category
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

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
}
