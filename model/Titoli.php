<?php

/**
 * Model class representing one Titoli item.
 */
final class Titoli {

    // priority
    //const PRIORITY_HIGH = 1;
    // status
    /**
     * The value for the autore field.
     * @var        string
     */
    private $autore;

    /**
     * The value for the esecutore field.
     * @var        string
     */
    private $esecutore;

    /**
     * The value for the cc_cn field.
     * @var        string
     */
    private $cc_cn;

    /**
     * The value for the editore field.
     * @var        string
     */
    private $editore;

    /**
     * The value for the brano field.
     * @var        string
     */
    private $brano;

    /**
     * The value for the id field.
     * @var        int
     */
    private $id;

    /**
     * The value for the isrc field.
     * @var        string
     */
    private $isrc;

    /**
     * The value for the produzioni_casa_id field.
     * @var        int
     */
    private $produzioni_casa_id;

    /**
     * The value for the produzioni_casa field.
     * @var        string
     */
    private $produzioni_casa;

    /**
     * The value for the tipo_prod_titoli field.
     * @var        string
     */
    private $tipo_prod_titoli;

    /**
     * The value for the tipo_traccia field.
     * @var        string
     */
    private $tipo_traccia;

    /**
     * The value for the durata field.
     * @var        int
     */
    private $durata;

    /**
     * The value for the data_creazione field.
     * @var        string
     */
    private $data_creazione;

    /**
     * The value for the isrc_video field.
     * @var        string
     */
    private $isrc_video;

    /**
     * The value for the proprieta_master field.
     * @var        string
     */
    private $proprieta_master;

    /**
     * The value for the id_m field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    private $id_m;

    /**
     * The value for the id_opere field.
     * @var        int
     */
    private $id_opere;

    /**
     * The value for the produttore field.
     * @var        string
     */
    private $produttore;

    /**
     * The value for the compositore field.
     * @var        string
     */
    private $compositore;

    /**
     * The value for the altri_esecutori field.
     * @var        string
     */
    private $altri_esecutori;

    /**
     * The value for the note field.
     * @var        string
     */
    private $note;

    /**
     * The value for the genere field.
     * @var        string
     */
    private $genere;

    /**
     * The value for the subgenere field.
     * @var        string
     */
    private $subgenere;

    /**
     * The value for the anno field.
     * @var        int
     */
    private $anno;

    /**
     * The value for the filepath field.
     * @var        string
     */
    private $filepath;

    /**
     * The value for the musician_choice field.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    private $musician_choice;

    /**
     * The value for the musician_chooser field.
     * @var        string
     */
    private $musician_chooser;

    /**
     * The value for the uselevel field.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    private $uselevel;

    /**
     * The value for the qualificator field.
     * Note: this column has a database default value of: 'nessuno'
     * @var        string
     */
    private $qualificator;

    /**
     * The value for the sync_it field.
     * @var        int
     */
    private $sync_it;

    /**
     * The value for the prezzo_base field.
     * @var        string
     */
    private $prezzo_base;

    /**
     * The value for the cantato field.
     * @var        int
     */
    private $cantato;

    /**
     * The value for the descrizione field.
     * @var        string
     */
    private $descrizione;

    /**
     * The value for the tipo_trattativa field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    private $tipo_trattativa;

    /**
     * The value for the prezzo_minimo field.
     * @var        string
     */
    private $prezzo_minimo;

    /**
     * The value for the title_file_id field.
     * @var        int
     */
    private $title_file_id;
    
    /**
     * Create new {@link Titoli} with default properties set.
     */
    public function __construct() {
        $now = new DateTime();
    }

    /*public static function allStatuses() {
        return array(
            self::STATUS_PENDING,
            self::STATUS_DONE,
            self::STATUS_VOIDED,
        );
    }*/

    //~ Getters & setters

    /**
     * @return int <i>null</i> if not persistent
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        if ($this->id !== null && $this->id != $id) {
            throw new Exception('Cannot change identifier to ' . $id . ', already set to ' . $this->id);
        }
        $this->id = (int) $id;
    }

    /**
     * @return int one of 1/2/3
     */
   /* public function getPriority() {
        return $this->priority;
    }

    public function setPriority($priority) {
        TodoValidator::validatePriority($priority);
        $this->priority = $priority;
    }*/

    /**
     * @return DateTime
     */
    public function getCreatedOn() {
        return $this->createdOn;
    }

    public function setCreatedOn(DateTime $createdOn) {
        $this->createdOn = $createdOn;
    }

    /**
     * @return DateTime
     */
    public function getDueOn() {
        return $this->dueOn;
    }

    public function setDueOn(DateTime $dueOn) {
        $this->dueOn = $dueOn;
    }

    /**
     * @return DateTime
     */
    public function getLastModifiedOn() {
        return $this->lastModifiedOn;
    }

    public function setLastModifiedOn(DateTime $lastModifiedOn) {
        $this->lastModifiedOn = $lastModifiedOn;
    }

    /**
     * @return string
     */
    public function getAltriEsecutori() {
        return $this->altri_esecutori;
    }

    public function setAltriEsecutori($altri_esecutori) {
        $this->altri_esecutori = $altri_esecutori;
    }

    /**
     * @return int
     */
    public function getAnno() {
        return $this->anno;
    }

    public function setAnno($anno) {
        $this->anno = (int)$anno;
    }

    /**
     * @return string
     */
    public function getAutore() {
        return $this->autore;
    }

    public function setAutore($autore) {
        $this->autore = $autore;
    }

    /**
     * @return string
     */
    public function getBrano() {
        return $this->brano;
    }

    public function setBrano($brano) {
        $this->brano = $brano;
    }
      /**
     * @return string
     */
    public function getCcCn() {
        return $this->cc_cn;
    }

    public function setCcCn($cc_cn) {
        $this->cc_cn = $cc_cn;
    }
    
         /**
     * @return string
     */
    public function getCompositore() {
        return $this->compositore;
    }

    public function setCompositore($compositore) {
        $this->compositore = $compositore;
    }
             /**
     * @return datetime
     */
    public function getDataCreazione() {
        return $this->data_creazione;
    }

    public function setDataCreazione(DateTime $data_creazione) {
        $this->data_creazione = $data_creazione;
    }
    
    /** 
    * @return string
     */
    public function getDescrizione() {
        return $this->descrizione;
    }

    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }
    
    /** 
    * @return int
     */
    public function getDurata() {
        return $this->durata;
    }

    public function setDurata($durata) {
        $this->durata = (int)$durata;
    }
    
    /** 
    * @return string
     */
    public function getEditore() {
        return $this->editore;
    }

    public function setEditore($editore) {
        $this->editore = $editore;
    }
        /** 
    * @return string
     */
    public function getEsecutore() {
        return $this->esecutore;
    }

    public function setEsecutore($esecutore) {
        $this->esecutore = $esecutore;
    }
        /** 
    * @return string
     */
    public function getFilepath() {
        return $this->filepath;
    }

    public function setFilepath($filepath) {
        $this->filepath = $filepath;
    }
    /** 
    * @return string
    */
    public function getGenere(){
        return $this->genere;
    }

    public function setGenere($genere) {
        $this->genere = $genere;
    }
    /** 
    * @return int
    */
    public function getIdM(){
        return $this->id_m;
    }

    public function setIdM($id_m) {
        $this->id_m = $id_m;
    }
        /** 
    * @return int
    */
    public function getIdOpere(){
        return $this->idOpere;
    }

    public function setIdOpere($idOpere) {
        $this->idOpere = $idOpere;
    }
            /** 
    * @return string
    */
    public function getISRC(){
        return $this->isrc;
    }

    public function setISRC($isrc) {
        $this->isrc = $isrc;
    }
    /** 
    * @return string
    */
    public function getISRCVideo(){
        return $this->isrc_video;
    }

    public function setISRCVideo($isrc_video) {
        $this->isrc_video = $isrc_video;
    }
    /** 
    * @return int
    */
    public function getMusicianChoice(){
        return $this->musician_choice;
    }

    public function setMusichianChoice($musician_choice) {
        $this->musician_choice = $musician_choice;
    }
    
      /** 
    * @return string
    */
    public function getMusicianChooser(){
        return $this->musician_chooser;
    }

    public function setMusichianChooser($musician_chooser) {
        $this->musician_chooser = $musician_chooser;
    }
    /** 
    * @return string
    */
    public function getProduzioniCasaId(){
        return $this->produzioni_casa_id;
    }

    public function setProduzioniCasaId($produzioni_casa_id) {
        $this->produzioni_casa_id = $produzioni_casa_id;
    }    

    /**
     * @return string 
     */
    public function getTipoTrattativa() {
        return $this->tipo_trattativa;
    }

    public function setTipoTrattativa($tipo_trattativa) {
        //TodoValidator::validateStatus();
        $this->tipo_trattativa = $tipo_trattativa;
    }
    
        /**
     * @return string 
     */
    public function getCantato() {
        return $this->cantato;
    }

    public function setCantato($cantato) {
        //TodoValidator::validateStatus();
        $this->cantato = $cantato;
    }
    
    public function getProduzioniCasa() {
        return $this->produzioni_casa;
    }

    public function setProduzioniCasa($produzioni_casa) {
        //TodoValidator::validateStatus();
        $this->produzioni_casa = $produzioni_casa;
    }
    public function getTipoProdTitoli() {
        return $this->tipo_prod_titoli;
    }

    public function setTipoProdTitoli($tipo_prod_titoli) {
        //TodoValidator::validateStatus();
        $this->tipo_prod_titoli = $tipo_prod_titoli;
    }
    public function getProprietaMaster() {
        return $this->proprieta_master;
    }

    public function setProprietaMaster($proprieta_master) {
        //TodoValidator::validateStatus();
        $this->proprieta_master = $proprieta_master;
    }
    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        //TodoValidator::validateStatus();
        $this->note = $note;
    }
    public function getPrezzoBase() {
        return $this->prezzo_base;
    }

    public function setPrezzoBase($prezzo_base) {
        //TodoValidator::validateStatus();
        $this->prezzo_base = $prezzo_base;
    }
    
    public function getDurataMin(){
        if($this->getDurata()> 0)
            return (int)($this->getDurata()/60);
    }
    public function getDurataSec(){
        if($this->getDurata()> 0)
            return $this->getDurata()%60;
    }

      /**
     * @return boolean
     */
    /*public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($deleted) {
        $this->deleted = (bool) $deleted;
    }*/

}

?>
