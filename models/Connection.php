<?php

class Connection
{
    /*  public static function connect()
     {
         // set db variables
         define('DB_HOST', 'localhost');
         define('DB_USERNAME', 'root');
         define('DB_PASSWORD', 'loveisall21');
         define('DB_NAME', 'php_pos');
         define('DB_DRIVER', 'mysql');

         $conn_string = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;

         if (!$link = new PDO($conn_string, DB_USERNAME, DB_PASSWORD)) {
             exit('Could not connect to DB');
         }
         return $link;
     }
 */
    public static function connect()
    {
        $link = new PDO("mysql:host=localhost;dbname=php_pos", "root", "loveisall21");

        $link -> exec("set names utf8");

        return $link;
    }
}