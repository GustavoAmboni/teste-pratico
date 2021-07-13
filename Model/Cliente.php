<?php

require "db/Database.php";

class Cliente
{
    public int $id;
    public String $nome;
    public String $sobrenome;
    public String $cnpj;
    public int $telefone;
    public String $dataCadastro;
    public Endereco $endereco;

    public function __construct(String $nome, String $sobrenome, String $cnpj, int $telefone, String $dataCadastro, Endereco $endereco, Int $id = 0)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->cnpj = $cnpj;
        $this->telefone = $telefone;
        $this->dataCadastro = $dataCadastro;
        $this->endereco = $endereco;
    }

    public static function selectAll()
    {
        $db = Connection::getConnection();

        $sql = "SELECT 
                cliente.nome, cliente.sobrenome, cliente.cnpj, cliente.telefone, cliente.dataCadastro, 
                cliente.id, endereco.estado, endereco.cidade, endereco.bairro, endereco.rua, endereco.cep, 
                endereco.numero
            FROM cliente 
            INNER JOIN endereco 
            ON cliente.idEndereco = endereco.id 
            ORDER BY cliente.id DESC";
        $sql = $db->prepare($sql);
        $sql->execute();

        $clientes = [];

        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $clientes[] = new Cliente(
                $row['nome'],
                $row['sobrenome'],
                $row['cnpj'],
                $row['telefone'],
                $row['dataCadastro'],
                new Endereco(
                    $row['estado'],
                    $row['cidade'],
                    $row['bairro'],
                    $row['rua'],
                    $row['cep'],
                    $row['numero']
                ),
                $row['id']
            );
        }
        return $clientes;
    }

    public static function selectOne(int $id)
    {

        $db = Connection::getConnection();

        $sql = "SELECT 
                cliente.nome, cliente.sobrenome, cliente.cnpj, cliente.telefone, cliente.dataCadastro, 
                cliente.id, endereco.estado, endereco.cidade, endereco.bairro, endereco.rua, endereco.cep, 
                endereco.numero
            FROM cliente 
            INNER JOIN endereco 
            ON cliente.idEndereco = endereco.id 
            WHERE cliente.id = :id
            ORDER BY cliente.id DESC";
        $sql = $db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        if ($row) {

            $client = new Cliente(
                $row['nome'],
                $row['sobrenome'],
                $row['cnpj'],
                $row['telefone'],
                $row['dataCadastro'],
                new Endereco(
                    $row['estado'],
                    $row['cidade'],
                    $row['bairro'],
                    $row['rua'],
                    $row['cep'],
                    $row['numero']
                ),
                $row['id']
            );
        } else {
            throw new Exception("Cliente não encontrado.");
        }

        return $client;
    }

    public static function create(Cliente $cliente)
    {
        $db = Connection::getConnection();

        $sql = 'INSERT INTO endereco (estado, cidade, bairro, rua, cep, numero) VALUES (:estado, :cidade, :bairro, :rua, :cep, :numero)';

        $sql = $db->prepare($sql);
        $sql->bindValue(":estado", $cliente->getEndereco()->getEstado());
        $sql->bindValue(":cidade", $cliente->getEndereco()->getCidade());
        $sql->bindValue(":bairro", $cliente->getEndereco()->getBairro());
        $sql->bindValue(":rua", $cliente->getEndereco()->getRua());
        $sql->bindValue(":cep", $cliente->getEndereco()->getCep());
        $sql->bindValue(":numero", $cliente->getEndereco()->getNumero());

        if (!$sql->execute()) {
            throw new Exception("Falha ao inserir no banco de dados.");
        }

        $enderecoId = $db->lastInsertId();

        $sql = 'INSERT INTO cliente (nome, sobrenome, cnpj, telefone, idEndereco) VALUES (:nome, :sobrenome, :cnpj, :telefone, :idEndereco)';

        $sql = $db->prepare($sql);
        $sql->bindValue(":nome", $cliente->getNome());
        $sql->bindValue(":sobrenome", $cliente->getSobrenome());
        $sql->bindValue(":cnpj", $cliente->getCnpj());
        $sql->bindValue(":telefone", $cliente->getTelefone());
        $sql->bindValue(":idEndereco", $enderecoId);

        if (!$sql->execute()) {
            throw new Exception("Falha ao inserir no banco de dados.");
        }
    }

    public static function delete(int $id)
    {
        $db = Connection::getConnection();

        $sql = 'DELETE FROM cliente WHERE cliente.id = :id';

        $sql = $db->prepare($sql);
        $sql->bindValue(":id", $id);

        if (!$sql->execute()) {
            throw new Exception("Falha ao deletar o cliente.");
        }
    }

    public static function update(Cliente $cliente)
    {
        $db = Connection::getConnection();

        $sql = 'UPDATE endereco INNER JOIN cliente ON cliente.idEndereco = endereco.id  SET estado = :estado, cidade = :cidade, bairro = :bairro, rua = :rua, cep = :cep, numero = :numero WHERE cliente.id = :id';

        $sql = $db->prepare($sql);
        $sql->bindValue(":estado", $cliente->getEndereco()->getEstado());
        $sql->bindValue(":cidade", $cliente->getEndereco()->getCidade());
        $sql->bindValue(":bairro", $cliente->getEndereco()->getBairro());
        $sql->bindValue(":rua", $cliente->getEndereco()->getRua());
        $sql->bindValue(":cep", $cliente->getEndereco()->getCep());
        $sql->bindValue(":numero", $cliente->getEndereco()->getNumero());
        $sql->bindValue(":id", $cliente->getId());

        if (!$sql->execute()) {
            throw new Exception("Falha ao atualizar o banco de dados.");
        }

        $sql = 'UPDATE cliente SET nome = :nome, sobrenome = :sobrenome, cnpj = :cnpj, telefone = :telefone WHERE cliente.id = :id';

        $sql = $db->prepare($sql);
        $sql->bindValue(":nome", $cliente->getNome());
        $sql->bindValue(":sobrenome", $cliente->getSobrenome());
        $sql->bindValue(":cnpj", $cliente->getCnpj());
        $sql->bindValue(":telefone", $cliente->getTelefone());
        $sql->bindValue(":id", $cliente->getId());

        if (!$sql->execute()) {
            throw new Exception("Falha ao atualizar o banco de dados.");
        }
    }

    public function getId()
    {
        return $this->id;
    }

    private function setId(int $id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome(String $nome)
    {
        $this->nome = $nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function setSobrenome(String $sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setCnpj(String $cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone(int $telefone)
    {
        $this->telefone = $telefone;
    }

    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    private function setDataCadastro(String $dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }
}
