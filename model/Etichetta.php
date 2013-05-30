<?php

final class Etichetta {

private $codice;
private $nome;
private $id;
public function __construct() {
}
    public function getCodice(){
        return $this->codice;
    }

    public function setCodice($codice) {
        $this->codice = $codice;
    }
    
    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
}
