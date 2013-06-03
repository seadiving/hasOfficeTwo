<?php

final class GeneriSearchCriteria {
    private $genere;
    private $lang ;
    
    public function getGenere(){
        return $this->genere;
    }
    
    public function setGenere($genere){
        $this->genere = $genere;
    }
    
    public function getLang(){
        return $_REQUEST['lang'];
    }

}

?>
