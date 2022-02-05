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
}