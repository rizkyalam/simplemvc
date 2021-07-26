<?php 

namespace Core;

use PDO;

class Database
{
    private static $_connection;
    private static $_host;
    private static $_dbname;
    private static $_username;
    private static $_password;

    /**
     * Make a connection to the database.
     */
    public static function connect()
    {
        $config = self::$_connection.
        ':host='.self::$_host.
        ';dbname='.self::$_dbname;

        $conn = new PDO($config, self::$_username, self::$_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn;
    }

    /**
     * Setup the database configuration
     */
    public static function init()
    {
        self::$_connection = getenv('DB_CONNECTION');
        self::$_host = getenv('DB_HOST');
        self::$_dbname = getenv('DB_DATABASE');
        self::$_username = getenv('DB_USERNAME');
        self::$_password = getenv('DB_PASSWORD');
    }
}
