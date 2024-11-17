<?php
namespace App\Model\Entity\Interfaces;

interface EntityInterface
{
    public function setId(int $id): void;
    public function getId(): int;
    public function hydrate(array $dados): EntityInterface;
}
