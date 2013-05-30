<?php

final class Permesso {
// può essere manage o publisher_manage
const RUOLO_MANAGE = 'MANAGE';
const RUOLO_PUBLISHER_MANAGE = 'PUBLISHER_MANAGE';

private $ruolo;
private $produzione_casa = null;
private $publisher = null;

public function __construct() {

}

   public function caricaPermesso($name){
       //name
       $permessi = explode("_",$name);
       //permesso etichetta
       if($permessi[1] == Permesso::RUOLO_MANAGE){
           $this->produzione_casa = $permessi[0];
       }else{
           $this->publisher = $permessi[0];
       }
    }
    
    public function getRuolo(){
        return $this->ruolo;
    }

    public function setRuolo($ruolo) {
        $this->ruolo = $ruolo;
    }

    public function getProduzioneCasa(){
        return $this->produzione_casa;
    }

    public function setProduzioneCasa($produzione_casa) {
        $this->produzione_casa = $produzione_casa;
    }   

    public function getPublisher(){
        return $this->publisher;
    }

    public function setPublisher($publisher) {
        $this->publisher = $publisher;
    }     
}
