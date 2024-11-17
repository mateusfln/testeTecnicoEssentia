<?php

namespace App\Model\Entity;

use App\Model\Entity\Interfaces\EntityInterface;

class Imagem implements EntityInterface
{
    private int $id;
    
    private int $maxSize = 2097152;

    private array $typesOfFile = ['jpg', 'png'];
    
    private string $basePath = "public/images/";
    
    private string $fullPath;
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getMaxSize(): int
    {
        return $this->maxSize;
    }
    
    public function getTypesOfFile(): array
    {
        return $this->typesOfFile;
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function getFullPath(): string
    {
        return $this->fullPath;
    }

    public function validate(string $name, string $error, int $size, string $tmpName): bool
    {
        if ($name){
            $nameOfImage = uniqid();
            $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $fullPath = $this->getBasePath().$nameOfImage.".".$extension;

            if($error){
                return 'Falha ao enviar a imagem';
            }

            if($size > $this->getMaxSize()){
                return (`Imagem maior que o limite máximo de tamanho {$this->convertToMegaBytes()} Mb`);
            }
            
            if(!in_array($extension, $this->getTypesOfFile())){
                return 'Tipo de imagem não aceita';
            }
            move_uploaded_file($tmpName, $fullPath);
            $this->setFullPath($fullPath);
            return true;
        }
        return false;
    }


    private function convertToMegaBytes(): int
    {
        return ($this->getMaxSize()/1000);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    
    public function setFullPath(string $fullPath): void
    {
        $this->fullPath = $fullPath;
    }

    public function hydrate(array $dados): Imagem 
    {
        $imagem = new $this();
        $imagem->setId($dados['id'] ?? '');
        $imagem->setFullPath($dados['ds_path'] ?? '');

        return $imagem;
    }
}