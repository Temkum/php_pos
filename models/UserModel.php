<?php

require_once "Connection.php";

/**
 *
 */
class UserModel
{
    public static function showUsers($table, $item, $value)
    {
        $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

        $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
        $stmt = null;
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
        $stmt->close();
        $stmt = null;
    }
}
