<?php

require_once "Connection.php";

/**
 *
 */
class UserModel
{
    public static function showUsers($table, $item, $value)
    {
        if ($item != null) {
            // return single user from db
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {
            // return all users
            $stmt = Connection::connect()->prepare("SELECT * FROM $table");

            $stmt->execute();
            return $stmt->fetchAll();
        }
        unset($stmt);
    }

    public static function addUser($table, $data)
    {
        $query = "INSERT INTO $table(name, username, password, role, photo) VALUES(:name, :username, :password, :role, :photo)";
        $stmt = Connection::connect()->prepare($query);

        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
        $stmt->bindParam(':role', $data['role'], PDO::PARAM_STR);
        $stmt->bindParam(':photo', $data['photo'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'OK';
        } else {
            return 'error';
        }
        unset($stmt);
    }
    
    public static function modifyUser($table, $data)
    {
        $sql = "UPDATE $table SET name=:name, username=:username, password=:password, role=:role, photo=:photo WHERE username=:username";
        $stmt = Connection::connect()->prepare($sql);

        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
        $stmt->bindParam(':role', $data['role'], PDO::PARAM_STR);
        $stmt->bindParam(':photo', $data['photo'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'OK';
        } else {
            return 'error';
        }
        unset($stmt);
    }

    public static function activateUser($table, $item1, $value1, $item2, $value2)
    {
        $stmt = Connection::connect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'OK';
        } else {
            return 'error';
        }
        $stmt->close();
        $stmt = null;
    }

    public static function deleteUser($table, $data)
    {
        $sql = "DELETE FROM $table WHERE id=:id";
        $stmt = Connection::connect()->prepare($sql);
        
        $stmt->bindParam(':id', $data, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'OK';
        } else {
            return 'error';
        }
        $stmt->close();
        $stmt = null;
    }
}
