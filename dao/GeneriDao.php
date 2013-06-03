<?php


final class GeneriDao {
    //use TitoliSearchCriteria;
    /** @var PDO */
    private $db = null;


    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    
    public function find(GeneriSearchCriteria $search = null) {
        $result = array();
        //$stmt = null;
        $stmt = $this->query($this->getFindSql($search));
            foreach ($stmt as $row) {
                $generi = new Generi();
                GeneriMapper::map($generi, $row);
                $result[$generi->getId()] = $generi;
            }
         return $result;
    }

    private function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        //echo('prima del config');
        $config = Config::getConfig("db");
        try {
            $this->db = new PDO($config['dsn'], $config['username'], $config['password']);
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }

     private function getFindSql(GeneriSearchCriteria $search = null) {
        $sql = 'SELECT * FROM generi';
        if($search != null && strlen($search->getGenere()) > 0)
            $sql .= 'WHERE MATCH(genere) AGAINST('.$this->db->quote($search->getGenere()."%") ;
        $orderBy = ' genere ';
        $sql .= ' ORDER BY ' . $orderBy;
        return $sql;
    }
    /**
     * @return Todo
     * @throws Exception
     */
    private function execute($sql, Titoli $titoli) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($titoli));
        if (!$titoli->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new Exception('Titoli with ID "' . $titoli->getId() . '" does not exist.');
        }
        return $titoli;
    }

    private function getParams(Titoli $titoli) {
        $params = array(
            ':id' => $titoli->getId(),
            ':brano'=> $titoli->getBrano(),
            ':autore'=> $titoli->getAutore(),
            ':esecutore'=> $titoli->getEsecutore(),
            ':editore'=> $titoli->getEditore(),
            ':anno'=> $titoli->getAnno(),
            ':ISRC'=> $titoli->getISRC(),
            ':produzioni_casa'=> $titoli->getProduzioniCasa(),
            ':produzioni_casa_id'=> $titoli->getProduzioniCasaId(),
            ':tipo_prod_titoli' => $titoli->getTipoProdTitoli(),
            ':durata'=> $titoli->getDurata(),
            ':proprieta_master'=> $titoli->getProprietaMaster(),
            ':note'=> $titoli->getNote(),
            ':descrizione'=> $titoli->getDescrizione(),
            ':tipo_trattativa'=> $titoli->getTipoTrattativa(),
            ':prezzo_base'=> $titoli->getPrezzoBase(),
            ':cantato'=> $titoli->getCantato(),
            ':compositore'=> $titoli->getCompositore(),
            ':genere'=> $titoli->getGenere(),
            ':subgenere'=> $titoli->getSubgenere(),
            ':prezzo_minimo'=> $titoli->getPrezzoMinimo(),
            ':testo_brano'=> $titoli->getTestoBrano()
        );

        return $params;
    }

    private function executeStatement(PDOStatement $statement, array $params) {
        if (!$statement->execute($params)) {
            self::throwDbError($this->getDb()->errorInfo());
        }
    }

    /**
     * @return PDOStatement
     */
    private function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        if ($statement === false) {
            self::throwDbError($this->getDb()->errorInfo());
        }
        return $statement;
    }
    

    private static function throwDbError(array $errorInfo) {
        // TODO log error, send email, etc.
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }

}

?>
