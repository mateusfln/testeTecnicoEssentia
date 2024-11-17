<?php

namespace App\Model\Entity;

use App\Model\Entity\Interfaces\EntityInterface;
use DateTime;

class Cliente implements EntityInterface
{
    private int $id;
    
    private string $ds_nome;

    private \DateTime $dt_nascimento;
    
    private string $ds_cpf;
    
    private string $ds_email;

    private string $ds_telefone;
    
    private string $ds_urlfoto;
    
    private Imagem $image;
    
    private string $ds_estadocivil;

    private array $requiredFields = [
        'ds_nome', 
        'dt_nascimento',
        'ds_cpf',
        'dt_nascimento',
        'ds_email',
        'ds_telefone',
        'estadocivil_id',
    ];

    public function __construct(int $id = 1, string $ds_nome = "", DateTime $dt_nascimento = new DateTime(""), string $ds_cpf = "", string $ds_email = "", string $ds_telefone = "", string $ds_estadocivil = "")
    {
        $this->id = $id;
        $this->ds_nome = $ds_nome;
        $this->dt_nascimento = $dt_nascimento;
        $this->ds_cpf = $ds_cpf;
        $this->ds_email = $ds_email;
        $this->ds_telefone = $ds_telefone;
        $this->ds_estadocivil = $ds_estadocivil;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setNome($nome): void
    {
        $this->ds_nome = $nome;
    }
    public function getNome(): string
    {
        return $this->ds_nome;
    }

    public function setDataDeNascimento($dataDeNascimento): void
    {
        $this->dt_nascimento = $dataDeNascimento;
    }

    public function getDataDeNascimento(): \DateTime
    {
        return $this->dt_nascimento;
    }

    public function setCpf($cpf): void
    {
        $this->ds_cpf = $cpf;
    }

    public function getCpf(): string
    {
        return $this->ds_cpf;
    }

    public function setEmail($email): void
    {
        $this->ds_email = $email;
    }

    public function getEmail(): string
    {
        return $this->ds_email;
    }
    public function setTelefone($telefone): void
    {
        $this->ds_telefone = $telefone;
    }

    public function getTelefone(): string
    {
        return $this->ds_telefone;
    }
    public function setUrlfoto($urlfoto): void
    {
        $this->ds_urlfoto = $urlfoto;
    }

    public function getUrlfoto(): string
    {
        return $this->ds_urlfoto;
    }

    public function setEstadoCivil($estadoCivil): void
    {
        $this->ds_estadocivil = $estadoCivil;
    }

    public function getEstadoCivil(): string
    {
        return $this->ds_estadocivil;
    }

    public function getRequiredFields()
    {
        return $this->requiredFields;
    }

    public function hydrate(array $dados): Cliente 
    {
        $clientes = new Cliente();
        $clientes->setNome($dados['ds_nome'] ?? '');
        $clientes->setDataDeNascimento(new DateTime($dados['dt_nascimento']) ?? '');
        $clientes->setCpf($dados['ds_cpf'] ?? '');
        $clientes->setEmail($dados['ds_email'] ?? '');
        $clientes->setTelefone($dados['ds_telefone'] ?? '');
        $clientes->setUrlfoto($dados['ds_urlfoto'] ?? '');
        $clientes->setEstadoCivil($dados['ds_estadocivil'] ?? '');

        return $clientes;
    }
}