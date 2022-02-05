<?php

class CategoryModel
{
    public static function addCategory($table, $data)
    {
        $query = "INSERT INTO $table(category_name) VALUES(:category_name)";
        $stmt = Connection::connect()->prepare($query);
        $stmt->bindParam(':category_name', $data, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'OK';
        } else {
            return 'error';
        }
        $stmt->close();
        $stmt = null;
    }

    public static function loadCategories($table, $item, $value)
    {
        if ($item != null) {
            // get single category
            $stmt=Connection::connect()->prepare("SELECT * FROM $table WHERE $item=:item");
            $stmt->bindParam(':'.$item, $value, PDO::PARAM_STR);
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