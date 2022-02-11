<?php

// require_once 'Connection.php';

class ClientModel
{
    public static function addClient($table, $data)
    {
        $query = "INSERT INTO $table(name, document_id, email, phone, address) VALUES(:name, :document_id, :email, :phone, :address)";

        $stmt = Connection::connect()->prepare($query);
        
        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":document_id", $data["document_id"], PDO::PARAM_INT);
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $data["phone"], PDO::PARAM_STR);
        $stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'OK';
        } else {
            return 'error';
        }
        $stmt->close();
        $stmt = null;
    }

    public static function loadClients($table, $item, $value)
    {
        if ($item != null) {
            // get single client
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

            $stmt->bindParam(":". $item, $value, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
        } else {
            // get all clients
            $stmt=Connection::connect()->prepare("SELECT * FROM $table");
            $stmt->execute();
            
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }
}
