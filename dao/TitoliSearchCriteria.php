<?php

final class TitoliSearchCriteria {

    private $titolo = null;
    private $isrc = null;
    private $paging = true;
    private $utente = null;

    public function __construct() {
       if(isset($_SESSION['user'])){
           $this->utente = $_SESSION['user'];
       } 
    }    

    public function getTitolo() {
        return trim($this->titolo);
    }

     public function getTitoloUpper(){
         return strtoupper(trim($this->titolo));
     }

     public function setTitolo($titolo) {
        $this->titolo = $titolo;
        return $this;
    }
    
    public function getIsrc() {
        return $this->isrc;
    }

     public function setIsrc($isrc) {
        $this->isrc = $isrc;
        return $this;
    }
    
    public function isPaging(){
        return $this->paging;
    }

    public function setPaging(){
        return $this->paging;
    }

    public function getUtente() {
        return $this->utente;
    }

     public function setUtente($utente) {
        $this->utente = $utente;
        return $this;
    } 
}

?>
