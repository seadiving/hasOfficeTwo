<?php

/*
    $permesso = new Permesso();
    $permesso->setRuolo(Permesso::RUOLO_PUBLISHER_MANAGE);
    $permesso->setPublisher('BIXIO');
    $utente = new Utente();
    $utente->setUsername('graziano');
    $utente->setPassword(sha1('graziano'));
    $utente->setAttivo(Utente::UTENTE_ATTIVO);
    $utente->addPermesso($permesso);
*/


/*
require_once 'UserSearchCriteria.php';
require_once '../../config/Config.php';
require_once '../../model/Utente.php';
require_once '../../model/Permesso.php';
*/
final class UserDao {
    //use TitoliSearchCriteria;
    /** @var PDO */
    private $db = null;


    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link Todo}s by search criteria.
     * @return array array of {@link Todo}s
     */
    public function find(UserSearchCriteria $search = null) {
        $result = array();
        $resultUtente = array();
        //estraggo l'utente;
        foreach ($this->query($this->getFindSql($search)) as $row) {
            $utente = new Utente();
            
            if(array_key_exists('username', $row)) {
                $utente->setUsername($row['username']);
            }
            if(array_key_exists('password', $row)) {
                $utente->setPassword($row['password']);
            }
            if(array_key_exists('is_super_admin', $row)) {
                $utente->setTipoUtente($row['is_super_admin']);
            }
            if(array_key_exists('is_active', $row)) {
                $utente->setAttivo($row['is_active']);
            }
            if(array_key_exists('id', $row)) {
                $utente->setId($row['id']);
            }    
            
            array_push($resultUtente, $utente);
        }        
        //estraggo i permessi 
        foreach ($resultUtente as $uti){
            foreach ($this->query($this->getPermessiByIdUtente($uti->getId())) as $row) {
                if(array_key_exists('name', $row)) {
                    $permesso = new Permesso();
                    $permesso->caricaPermesso($row['name']);
                }
                $uti->addPermesso($permesso);
            }
            array_push($result,  $uti);
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
        $config = Config::getConfig("db");
        try {
            $this->db = new PDO($config['dsn'], $config['username'], $config['password']);
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }

    private function getFindSql(UserSearchCriteria $search = null) {
        $sql = 'SELECT * FROM sf_guard_user ';
        $orderBy = ' username ';
        if ($search !== null) {
            if($search->getUsername() !== null || $search->getPassword() !== null)
                $sql .=  'WHERE ';
            if ($search->getUsername() !== null) {
                $sql .= ' username = ' . $this->getDb()->quote($search->getUsername());
            }
            /*if($search->getPassword() !== null){
                 if ($search->getPassword() !== null)
                     $sql .= ' AND '; 
                $sql .=' password = '. $this->getDb()->quote($search->getSha1Password());
            }*/
        }
        $sql .= ' ORDER BY ' . $orderBy;
        echo "query list".$sql;
        return $sql;
    }
    
    private function getPermessiByIdUtente($idUtente) {
        $sql = 'SELECT gp.name FROM sf_guard_user_permission gup join sf_guard_permission gp on gup.permission_id = gp.id ';
        $orderBy = ' permission_id ';
        if ($idUtente > 0) {
            $sql .= 'where gup.user_id =  ' . $idUtente;
        }
        $sql .= ' ORDER BY ' . $orderBy;
        echo "query list".$sql;
        return $sql;
    }


    /**
     * @return Todo
     * @throws Exception
     */
    private function insert(Todo $todo) {
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

    private static function throwDbError(array $errorInfo) {
        // TODO log error, send email, etc.
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }

    private static function formatDateTime(DateTime $date) {
        return $date->format(DateTime::ISO8601);
    }

}

?>
