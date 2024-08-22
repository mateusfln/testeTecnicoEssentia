<?php

namespace App\Model\Entity;

class Estadocivil
{
    private int $id;

    private string $ds_estadocivil;


    public function __construct(int $id = 1, string $ds_estadocivil = "")
    {
        $this->id = $id;
        $this->ds_estadocivil = $ds_estadocivil;
    }

    
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
    
    public function setEstadoCivil($estadoCivil): void
    {
        $this->ds_estadocivil = $estadoCivil;
    }

    public function getEstadoCivil(): string
    {
        return $this->ds_estadocivil;
    }

    public function hydrate(array $dados): Estadocivil 
    {
        $estadocivis = new Estadocivil();
        $estadocivis->setEstadoCivil($dados['ds_estadocivil'] ?? '');

        return $estadocivis;
    }
}