<?php
class Database 
{
    private static $instance = null;

    public static function connect() 
    {
        if (self::$instance === null) 
        {
            self::$instance = new mysqli('localhost', 'root', '', 'inventory-system');
        }
        return self::$instance;
    }
}
?>