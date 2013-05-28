<?php

final class TitoliSearchCriteria {

    private $titolo = null;
    private $isrc = null;
    private $paging = true;



    public function getTitolo() {
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
}

?>
