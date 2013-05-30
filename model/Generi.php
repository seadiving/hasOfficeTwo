<?php

final class Generi {

    private $genere;
    private $genere_eng;
    
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

}

?>