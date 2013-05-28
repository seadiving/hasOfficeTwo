<?php

/**
 * Model class representing one Titoli item.
 */
final class Utente {
const TIPO_UTENTE_SUPERADMIN = '1';
const TIPO_UTENTE_NORMALE = '0';

const RUOLO_PUBLISHER_MANAGE = 'PUBLISHER_MANAGE';
const RUOLO_MANAGE = 'MANAGE';

const UTENTE_ATTIVO = '1';
const UTENTE_NON_ATTIVO = '0';

private $username;
private $password;
private $algoritmo;
private $permessi; 
private $tipoUtente;
private $attivo;
private $id;
public function __construct() {
    $this->permessi = array();
}
    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }
    
    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getAlgoritmo(){
        return $this->algoritmo;
    }

    public function setAlgoritmo($algoritmo) {
        $this->algoritmo = $algoritmo;
    }   

    public function getPermessi(){
        return $this->permessi;
    }

    public function setPermessi($permessi) {
        $this->permessi = $permessi;
    }
    
    public function getTipoUtente(){
        return $this->tipoUtente;
    }

    public function setTipoUtente($tipoUtente) {
        $this->tipoUtente = $tipoUtente;
    }
    
    public function getAttivo(){
        return $this->attivo;
    }

    public function setAttivo($attivo) {
        $this->attivo = $attivo;
    }
    
    
    public function addPermesso(Permesso $permesso){
        array_push($this->permessi, $permesso);
    }
    
    public function getId(){
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
}
