<?php 

namespace Core;

use PDO;

class Database
{
    private static $connection;
    private static $host;
    private static $dbname;
    private static $username;
    private static $password;

    public static function connect()
    {
        $config = self::$connection.
        ':host='.self::$host.
        ';dbname='.self::$dbname;

        $conn = new PDO($config, self::$username, self::$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn;
    }

    public static function init()
    {
        self::$connection = getenv('DB_CONNECTION');
        self::$host = getenv('DB_HOST');
        self::$dbname = getenv('DB_DATABASE');
        self::$username = getenv('DB_USERNAME');
        self::$password = getenv('DB_PASSWORD');
    }
}