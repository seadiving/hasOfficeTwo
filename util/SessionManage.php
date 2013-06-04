<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SessionManage
 *
 * @author grecius
 */
class SessionManage {
    private $utente;

    public function __construct() {
       if(!isset($_SESSION['user'])){
		   
           session_start();
       }
    }
    
    public function checkUtente(){
        if(!isset($_SESSION['user'])){
            session_destroy();
            header('Location: index.php?page=login/login');
        }
    }
    
     public function getUtente(){
         $this->checkUtente();
         if(!$this->utente){
            $this->utente =  $_SESSION['user'];
         }
       return $this->utente;
    }
    
    public function __destruct() {
        //session_destroy();
    }
}

$sessione = new SessionManage();
$utente = $sessione->getUtente();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

?>
