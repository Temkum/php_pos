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
}
