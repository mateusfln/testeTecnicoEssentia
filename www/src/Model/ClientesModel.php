<?php
namespace App\Model;

use App\Model\Database;
use App\Model\Entity\Cliente;
use Exception;
use PDO;

class ClientesModel
{

    private string $table;
    private Database $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance();
        $this->table = 'clientes';
    }

    public function findAll(): array|null
    {
        try {
            $query = $this->conn
            ->getConnection()
            ->query(
                "SELECT 
                {$this->table}.id,
                ds_nome, 
                dt_nascimento, 
                ds_cpf, 
                ds_email,
                ds_telefone,
                ds_urlfoto, 
                ds_estadocivil 
                FROM {$this->table}
                INNER JOIN estado_civil
                on {$this->table}.estadocivil_id = estado_civil.id 
                LIMIT 200;");

            $clientes = [];
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $cliente = new Cliente();
                $cliente->setId($row["id"]);
                $cliente->setNome($row['ds_nome']);
                $cliente->setCpf($row['ds_cpf']);
                $cliente->setEmail($row['ds_email']);
                $cliente->setTelefone($row['ds_telefone']);
                $cliente->setUrlfoto($row['ds_urlfoto']);
                $cliente->setDataDeNascimento(new \DateTime($row['dt_nascimento']));
                $cliente->setEstadoCivil($row['ds_estadocivil']);
                $clientes[] = $cliente;
            }
            // echo '<pre>';
            // print_r($clientes);
            // die;
            return $clientes;

        } catch (Exception $e) {
            echo 'Não foi possível executar a ação ' . $e->getMessage();
            return null;
        }
    }

    public function insert(): array
    {
        $this->validarCpfEmail($_POST['ds_cpf'], $_POST['ds_email']);
        try {
            $_POST['estadocivil_id'] = (int)$_POST['estadocivil_id'];
            $this->conn
            ->getConnection()
            ->exec(
                "INSERT INTO {$this->table} 
                    (
                    estadocivil_id,
                    ds_nome, 
                    dt_nascimento, 
                    ds_cpf, 
                    ds_email,
                    ds_telefone,
                    ds_urlfoto) 
                    VALUES (
                    {$_POST['estadocivil_id']},
                    '{$_POST['ds_nome']}', 
                    '{$_POST['dt_nascimento']}', 
                    '{$_POST['ds_cpf']}', 
                    '{$_POST['ds_email']}', 
                    '{$_POST['ds_telefone']}', 
                    '{$_POST['ds_urlfoto']}'
                    )"
                );
                return [true, ''];
        } catch (Exception $e) {
            return [false, $e->getMessage()];
        }
    }

    public function read($id): Cliente
    {
        $sql =
            "SELECT
            {$this->table}.id, 
            ds_nome, 
            dt_nascimento, 
            ds_cpf, 
            ds_email, 
            ds_telefone, 
            ds_urlfoto, 
            ds_estadocivil
            FROM {$this->table}
            INNER JOIN estado_civil
            on {$this->table}.estadocivil_id = estado_civil.id
            WHERE {$this->table}.id = {$id};";
        $query = $this->conn->getConnection()->query($sql);

        return (new Cliente())->hydrate($query->fetch(PDO::FETCH_ASSOC));
    }

    public function edit(int $id): array
    {
        $this->validarCpfEmail($_POST['ds_cpf'], $_POST['ds_email']);
        try {
            $this->conn
                ->getConnection()
                ->query(
                    "UPDATE {$this->table} SET
                estadocivil_id = '{$_POST['estadocivil_id']}',
                ds_nome = '{$_POST['ds_nome']}', 
                dt_nascimento = '{$_POST['dt_nascimento']}', 
                ds_cpf = '{$_POST['ds_cpf']}', 
                ds_email = '{$_POST['ds_email']}',
                ds_telefone = '{$_POST['ds_telefone']}',
                ds_urlfoto = '{$_POST['ds_urlfoto']}'
                WHERE id = {$id};
                "
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
                    "SELECT
                {$this->table}.id,
                ds_nome, 
                dt_nascimento, 
                ds_cpf, 
                ds_email, 
                ds_estadocivil 
                FROM {$this->table}
                INNER JOIN estado_civil
                on {$this->table}.estadocivil_id = estado_civil.id 
                WHERE {$this->table}.id = {$id}
                LIMIT 200;"
                );

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $cliente = new Cliente();
                $cliente->setId($id);
                $cliente->setNome($row['ds_nome']);
                $cliente->setCpf($row['ds_cpf']);
                $cliente->setEmail($row['ds_email']);
                $cliente->setDataDeNascimento(new \DateTime($row['dt_nascimento']));
                $cliente->setEstadoCivil($row['ds_estadocivil']);
            }
            return $cliente;
        } catch (Exception $e) {
            echo 'Não foi possível executar a ação ' . $e->getMessage();
        }
    }

    private function validaCPF($cpf): bool
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    private function validaEmail($email): bool 
    {
        $conta = "/^[a-zA-Z0-9\._-]+@";
        $dominio = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$/";
        $pattern = $conta.$dominio.$extensao;
        if (preg_match($pattern, $email, $check))
          return true;
        else
          return false;
      }

    private function validarCpfEmail(String $cpf, String $email)
    {
        if (!$this->validaCPF($cpf)) {
            return [false, 'ds_cpf'];
        }

        if (!$this->validaEmail($email)) {
            return [false, 'ds_email'];
        }
    }
}
