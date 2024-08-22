# Teste Técnico Desenvolvedor Php Jr Dígitro - CRUD de Funcionários

Este é um teste técnico proposto pela Digitro para avaliar conhecimentos e habilidades no desenvolvimento de uma aplicação web CRUD (Create, Read, Update, Delete) de funcionários utilizando PHP, MySQL e Docker.

## Descrição do Projeto

O objetivo deste projeto é criar uma aplicação web que permita gerenciar informações de funcionários, incluindo nome, cpf, email, data de nascimento e estado civil. A aplicação deve oferecer as seguintes funcionalidades:

- Cadastrar um novo funcionário.
- Visualizar a lista de funcionários cadastrados.
- Editar as informações de um funcionário existente.
- Excluir um funcionário da base de dados.

## Tecnologias Utilizadas

- **PHP**: Linguagem de programação utilizada para o desenvolvimento da aplicação.
- **MySQL**: Sistema de gerenciamento de banco de dados relacional utilizado para armazenar as informações dos funcionários.
- **Docker**: Plataforma de contêineres que facilita a criação, distribuição e execução de aplicativos em contêineres.
- **Docker Compose**: Ferramenta que auxilia na orquestragem de multiplos containeres docker ao mesmo tempo.

## Como Executar o Projeto

1. Certifique-se de ter o Docker instalado em sua máquina e também o Docker compose. Você pode baixar o Docker [aqui](https://www.docker.com/get-started) e o docker compose [aqui](https://docs.docker.com/compose/install/).
2. Clone este repositório em sua máquina local:

```
git clone https://github.com/mateusfln/crud-digitro.git
```

3. Navegue até o diretório do projeto:

```
cd crud-digitro
```

4. Inicie os contêineres Docker:

```
docker-compose up -d
```

5. Entre na raiz do projeto:

```
cd www
```

6. instale as dependencias do composer no projeto

```
composer update

```

7. Rode o arquivo de setup para criar as tabelas e colunas:


```
http://crud-digitro.localhost:84/setup.php

```

8. Acesse o endereço:

```
http://crud-digitro.localhost:84

```

## Estrutura do Projeto

A estrutura do projeto está organizada da seguinte forma:

```
/
|-- www/
|   |-- src/
|      |-- config/
|      |-- Controller/
|      |-- Model/
|      |-- View/
|-- docker-compose.yml
|-- Dockerfile
|-- site.conf
```
- **www/**: Diretório mapeado no Nginx para conter o projeto e disponibilizar na web).
- **src/**: Diretório contendo os arquivos PHP da aplicação organizados utilizando a arquitetura MVC (Model, View, Controler).
- **docker-compose.yml**: Arquivo de configuração do Docker Compose para criar e gerenciar os contêineres da aplicação.
- **Dockerfile**: Arquivo utilizado para sobrescrever uma imagem ja existente e instalar algumas dependencias necessárias.
- **site.conf**: Arquivo utilizado para organizar as configurações do site (Nginx, arquivos padrão e etc).
