<?php

namespace App\Model;
use PDO;
 /**
 * Classe do banco de dados utilizando o pattern Singleton
 */
class Database extends PDO
{
    private string $host = DB_HOST;

    private string $db = DB_DB;

    private string $username = DB_USERNAME;

    private string $password = DB_PASSWORD;

    private static $instance = null;
    
    private PDO $conn;

    private function __construct()
    {
        $this->conn = $this->conn();
    }

    private function conn() : PDO
    {
        $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", 
            $this->username, 
            $this->password);

        return $conn;
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getConnection() : PDO
    {
        return $this->conn;
    }
}
