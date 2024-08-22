<?php
namespace App\Model;

use App\Model\Database;
use App\Model\Entity\Estadocivil;
use Exception;
use PDO;

class EstadocivilModel
{

    private string $table;
    private Database $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance();
        $this->table = 'estado_civil';
    }

    public function findAll(): array|null
    {
        try {
            $query = $this->conn
            ->getConnection()
            ->query(
                "SELECT
                {$this->table}.id,
                ds_estadocivil 
                FROM {$this->table}
                LIMIT 200;");

            $estadocivis = [];
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $estadocivil = new Estadocivil();
                $estadocivil->setId($row["id"]);
                $estadocivil->setEstadoCivil($row['ds_estadocivil']);
                $estadocivis[] = $estadocivil;
            }
            return $estadocivis;

        } catch (Exception $e) {
            echo 'Não foi possível executar a ação ' . $e->getMessage();
            return null;
        }
    }
}
