<?php


/*
require_once 'TitoliSearchCriteria.php';
require_once '../../config/Config.php';
require_once '../../model/Titoli.php';
require_once '../../mapping/TitoliMapper.php';
 * 
 */
//require_once('Pager/Pager.php');

final class TitoliDao {
    //use TitoliSearchCriteria;
    /** @var PDO */
    private $db = null;
    private $linkPager = null;


    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link Todo}s by search criteria.
     * @return array array of {@link Todo}s
     */
    
    
    
    public function find(TitoliSearchCriteria $search = null) {
        $result = array();
        //$stmt = null;
        if($search->isPaging()){
            $stmt = $this->getFindPaged($search);
        }else{
            $stmt = $this->query($this->getFindSql($search));
        }
            foreach ($stmt as $row) {
                $titoli = new Titoli();
                TitoliMapper::map($titoli, $row);
                $result[$titoli->getId()] = $titoli;
            }
        
      
        return $result;
    }

    public function findLabels(TitoliSearchCriteria $search = null){
         $result = array();
         $stmt = $this->query($this->getfindLabelsSql($search));
         foreach ($stmt as $row) {
            $etichetta = new Etichetta();
            if (array_key_exists('id', $row)) {
                $etichetta->setId($row['id']);
            }
            if (array_key_exists('code', $row)) {
                $etichetta->setCodice($row['code']);
            }
            if (array_key_exists('name', $row)) {
                $etichetta->setNome($row['name']);
            }
            $result[$etichetta->getId()]= $etichetta;
        }
        return $result;
   }
    
       public function findById($id) {
        $row = $this->query('SELECT * FROM titoli WHERE id = ' . (int) $id)->fetch();
        if (!$row) {
            return null;
        }
        $titoli = new Titoli();
        TitoliMapper::map($titoli, $row);
        return $titoli;
    }

    public function save(Titoli $titoli) {
        if ($titoli->getId() === null) {
            return $this->insert($titoli);
        }
        return $this->update($titoli);
    }

    /**
     * Delete {@link Todo} by identifier.
     * @param int $id {@link Todo} identifier
     * @return bool <i>true</i> on success, <i>false</i> otherwise
     */
    public function delete($id) {
        $sql = '
            UPDATE todo SET
                last_modified_on = :last_modified_on,
                deleted = :deleted
            WHERE
                id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':last_modified_on' => self::formatDateTime(new DateTime()),
            ':deleted' => true,
            ':id' => $id,
        ));
        return $statement->rowCount() == 1;
    }

    /**
     * @return PDO
     */
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

     private function getFindSql(TitoliSearchCriteria $search = null) {
        $sql = 'SELECT  titoli.* FROM titoli ';
        if($search->getUtente() !== null){
            $sql .= ' inner join produzioni_casa on titoli.produzioni_casa = produzioni_casa.code ';
            $sql .= ' inner join publisher on produzioni_casa.publisher_id = publisher.id ';
        }
        $orderBy = ' brano ';
        if ($search !== null) {
            if($search->getTitolo() !== null || $search->getIsrc() !== null || $search->getUtente() !== null)
                $sql .=  'WHERE ';
            if ($search->getTitolo() !== null) {
                $sql .= ' brano like ' . $this->getDb()->quote('%'.$search->getTitoloUpper().'%');
            }
            if($search->getIsrc() !== null){
                 if ($search->getTitolo() !== null)
                     $sql .= ' AND '; 
                $sql .=' ISRC = '. $this->getDb()->quote(Utils::getFormatISRC($search->getIsrc()));
            }

            if($search->getUtente() !== null){
                if ($search->getTitolo() !== null || $search->getIsrc() !== null){
                    $sql .= ' AND ';
                    foreach($search->getUtente()->getPermessi() as $permesso){
                        if($permesso->getPublisher() !== null){
                            $sql .=' publisher.code = '.$this->getDb()->quote($permesso->getPublisher());
                        }else{
                            $sql .=' produzioni_casa.code = '.$this->getDb()->quote($permesso->getProduzioneCasa());
                        }
                    }
                }
            }
        }
        $sql .= ' ORDER BY ' . $orderBy;
        //$sql .= 'LIMIT 50';
       //echo "query list".$sql;
        return $sql;
    }
    /**
     * @return Todo
     * @throws Exception
     */
    private function insert(Titoli $titoli) {
        $now = new DateTime();
        $todo->setId(null);
        $todo->setCreatedOn($now);
        $todo->setLastModifiedOn($now);
        $todo->setStatus(Todo::STATUS_PENDING);
        $sql = '
            INSERT INTO todo (id, priority, created_on, last_modified_on, due_on, title, description, comment, status, deleted)
                VALUES (:id, :priority, :created_on, :last_modified_on, :due_on, :title, :description, :comment, :status, :deleted)';
        return $this->execute($sql, $todo);
    }

    /**
     * @return Todo
     * @throws Exception
     */
    private function update(Titoli $titoli) {
        $sql = '
            UPDATE titoli SET
                brano = :brano,
                autore = :autore,
                esecutore = :esecutore,
                editore = :editore,
                anno = :anno,
                ISRC = :ISRC,
                produzioni_casa = :produzioni_casa,
                produzioni_casa_id = :produzioni_casa_id,
                tipo_prod_titoli = :tipo_prod_titoli,
                durata = :durata,
                proprieta_master = :proprieta_master,
                note = :note,
                descrizione = :descrizione,
                tipo_trattativa = :tipo_trattativa,
                prezzo_base = :prezzo_base,
                cantato = :cantato
            WHERE
                id = :id';
        return $this->execute($sql, $titoli);
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
            ':cantato'=> $titoli->getCantato()
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
    
   private function getFindPaged(TitoliSearchCriteria $search = null){
        /* inizio esempio paginazione*/
        $stmt = $this->query($this->getFindSql($search));
        $stmt2 = null;
        if ($stmt){
        // begin pager
        //require_once('Pager/Pager.php');
        //require_once('Pager/Sliding.php');
        $extraVars = array('searchTitle'=>$search->getTitolo(),'searchIsrc'=>$search->getIsrc());
        $params = array(
        'totalItems' => $stmt->rowCount(),
        'perPage' => 10,
        'delta' => 8,
        'mode' => 'Jumping',
        'separator' => '|',
        'extraVars' => $extraVars
        );
        //echo 'paperino';
        $pager =& Pager::factory($params);

        $this->linkPager = $pager->getLinks();
        //echo $links['all'];

        // offset setup
        list($from, $to) = $pager->getOffsetByPageId();
        //$from = $from – 1;
        $perPage = $params['perPage'];
        if($stmt->rowCount() < $perPage){
            $stmt2 = $this->getDb()->prepare($this->getFindSql($search));
        }else{
        // 2nd query based on 1st with LIMIT – this will be displaying data per page
            $stmt2 = $this->getDb()->prepare($this->getFindSql($search).' LIMIT :from, :perPage');
            // address bug 44639 – forces the variables to have the property of integer instead of string so no quotes will surround it
            $stmt2->bindValue(':from', $from, PDO::PARAM_INT);
            $stmt2->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        }
        $stmt2->execute();
      }
        return $stmt2;

    }

    private function getfindLabelsSql(TitoliSearchCriteria $search = null){
        $sql = 'SELECT produzioni_casa.* FROM  produzioni_casa inner join publisher on produzioni_casa.publisher_id = publisher.id ';
       if($search->getUtente() !== null){
            if ($search->getTitolo() !== null || $search->getIsrc() !== null){
                $sql .= ' WHERE ';
                foreach($search->getUtente()->getPermessi() as $permesso){
                    if($permesso->getPublisher() !== null){
                        $sql .=' publisher.code = '.$this->getDb()->quote($permesso->getPublisher());
                    }else{
                        $sql .=' produzioni_casa.code = '.$this->getDb()->quote($permesso->getProduzioneCasa());
                    }
                }
            }
        }
        //echo 'query etichette '.$sql;
        return $sql;
                
    }
    private static function throwDbError(array $errorInfo) {
        // TODO log error, send email, etc.
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }

    private static function formatDateTime(DateTime $date) {
        return $date->format(DateTime::ISO8601);
    }
    
    public function getLinkPager(){
        return $this->linkPager;
    }

}

?>
