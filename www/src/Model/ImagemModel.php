<?php
namespace App\Model;

use App\Model\Database;
use App\Model\Entity\Imagem;
use App\Model\Entity\Interfaces\EntityInterface;
use Exception;
use PDO;

class ImagemModel
{
    private string $table;
    private Database $conn;
    private Imagem $entity;

    public function __construct(EntityInterface $imagemEntity)
    {
        $this->conn = Database::getInstance();
        $this->table = 'imagens';
        $this->entity = $imagemEntity;
    }

    public function findAll(): array|null
    {
        try {
            $query = $this->conn
            ->getConnection()
            ->query(
                    "SELECT id, ds_path, 
                    FROM {$this->table}
                    LIMIT 200;"
                );

            $imagens = [];
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $imagem = new $this->entity();
                $imagem->setId($row['id']);
                $imagem->setFullPath($row['ds_path']);
                $imagens[] = $imagem;
            }
            return $imagens;

        } catch (Exception $e) {
            echo 'Não foi possível executar a ação ' . $e->getMessage();
            return null;
        }
    }

    public function insert(): array
    {
        $this->entity->validate(
            $_FILES['image']['name'], 
            $_FILES['image']['error'], 
            $_FILES['image']['size'], 
            $_FILES['image']['tmp_name']
        );
        try{
            $this->conn
            ->getConnection()
            ->exec(
                "INSERT INTO {$this->table} 
                    (ds_path) 
                    VALUES 
                    ('{$_POST['ds_path']}')"
                );
            return [true, '']; 
        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }

    public function read(int $id): Imagem
    {
        $sql =
            "SELECT id, ds_path FROM {$this->table} 
            WHERE {$this->table}.id = {$id};";
        $query = $this->conn->getConnection()->query($sql);

        return (new $this->entity())->hydrate($query->fetch(PDO::FETCH_ASSOC));
    }

    public function edit(int $id): array
    {
        $this->entity->validate(
            $_FILES['image']['name'], 
            $_FILES['image']['error'], 
            $_FILES['image']['size'], 
            $_FILES['image']['tmp_name']
        );
        try {
            $this->conn
            ->getConnection()
            ->query(
                "UPDATE {$this->table} SET
                ds_path = '{$_POST['ds_path']}'
                WHERE id = {$id};"
            )->fetch(PDO::FETCH_ASSOC);

            return [true, ''];
 
        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }

    public function delete(int $id): array
    {
        try {
            $this->conn
            ->getConnection()
            ->query(
                "DELETE FROM {$this->table}
                 WHERE id = {$id};")
                 ->fetch(PDO::FETCH_ASSOC);
            
            return [true, ''];

        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }

    }

    public function findById(int $id)
    {
        try {
            $query = $this->conn->getConnection()
            ->query(
                "SELECT id, ds_path
                FROM {$this->table}
                WHERE id = {$id}
                LIMIT 50;"
            );

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $imagem = new $this->entity();
                $imagem->setId($row['id']);
                $imagem->setFullPath($row['ds_path']);
                $imagens[] = $imagem;
            }
            return $imagens;
        } catch (Exception $e) {
            echo 'Não foi possível executar a ação ' . $e->getMessage();
        }
    }
}
