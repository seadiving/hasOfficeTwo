<?php

final class Generi {

    private $genere;
    private $genere_eng;
    private $id;
    
    public function getGenere(){
        return $this->genere;
    }
    public function getGenereEng(){
        return $this->genere_eng;
    }
    public function setGenere($genere){
        $this->genere = $genere;
    }
    public function setGenereEng($genere_eng){
        $this->genere_eng = $genere_eng;
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

}

?>