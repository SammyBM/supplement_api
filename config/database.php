<?php

// REST API tutorial
// https://codeofaninja.com/create-simple-rest-api-in-php/


class Database
{

    private $host = 'localhost';
    private $db_name = 'supplement_arena';
    private $username = 'root';
    private $password = '';
    public $connection;

    public function getConnection()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db_name . ";charset=utf8", $this->username, $this->password);
            $this->connection->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->connection;
    }
    public function getBeautyConnection()
    {
        $this->connection = null;

        $conn = mysqli_connect( $this->host,$this->username,$this->password,$this->db_name);

        if (!$conn) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
            echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
            return NULL;
        }
        
        return $conn;
        
    }
}
