<?php
namespace App\Model\Interfaces;

use App\Model\Entity\Cliente;

interface ClientesModelInterface
{
    public function insert(): array;
    public function read(int $id): Cliente;
    public function edit(int $id): array;
    public function delete(int $id): array;
    public function findAll(): array|null;
    public function findById(int $id);
}
