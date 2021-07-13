<?php

abstract class Connection
{
    private static $connection;
    private static $host = "localhost";
    private static $dbname = "portaria";
    private static $user = "dev";
    private static $pass = "";

    public static function getConnection()
    {
        if (is_null(self::$connection)) {
            self::$connection = new PDO('mysql:host=' . self::$host . '; dbname=' . self::$dbname . ';', self::$user, self::$pass);
        }

        return self::$connection;
    }
}
