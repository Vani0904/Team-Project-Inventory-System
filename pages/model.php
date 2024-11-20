<?php

class Database 
{
    private $pdo = null;
    private $statement = null;

    function _construct()
    {
        $this->pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_USER, DB_PASSWORD, 
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
    }
}

function _destruct()
{
    if ($this->statement!==null) { $this->statement = null; }
    if ($this->pdo!==null) { $this->pdo = null; }
}

function _select_query($sql, $data=null)
{
    $this->statement = $this->pdo->prepare($sql);
    $this->statement->execute($data);
    return $this->statement->fetchAll();
}

define("DB_HOST", "localhost");
define("DB_NAME", "inventory-system");
define("DB_USER", "root");
define("DB_CHARSET", "utf8mb4");
define("DB_PASSWORD", "");

$_DB = new Database();

$connection = mysqli_connect($hostname, $username, $password, $db_name);