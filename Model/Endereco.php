<?php

class Endereco{
    public int $id;
    public String $estado;
    public String $cidade;
    public String $bairro;
    public String $rua;
    public int $cep;
    public int $numero;

    public function __construct(String $estado, String $cidade, String $bairro, String $rua, int $cep, int $numero)
    {
        $this->estado = $estado;
        $this->cidade = $cidade;
        $this->bairro = $bairro;
        $this->rua = $rua;
        $this->cep = $cep;
        $this->numero = $numero;
    }

    public function getId(){
        return $this->id;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado(String $estado){
        $this->estado = $estado;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function setCidade(String $cidade){
        $this->cidade = $cidade;
    }

    public function getBairro(){
        return $this->bairro;
    }

    public function setBairro(String $bairro){
        $this->bairro = $bairro;
    }

    public function getRua(){
        return $this->rua;
    }

    public function setRua(String $rua){
        $this->rua = $rua;
    }

    public function getCep(){
        return $this->cep;
    }

    public function setCep(int $cep){
        $this->cep = $cep;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function setNumero(int $numero){
        $this->numero = $numero;
    }
}