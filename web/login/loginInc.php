<?php

if(!isset($_REQUEST['lang']))
    $_REQUEST['lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

//session_start();
if(array_key_exists('action', $_GET) && $_GET['action'] == 'logout'){
    unset($_SESSION['user']);
    session_destroy();
}
$exit = false;
$errors = array();
$utente = null;
$username = array_key_exists('username', $_POST);
$password = array_key_exists('password', $_POST);
$userDao = new UserDao();
$search = new UserSearchCriteria();
if ($username && $password) {
    //ricerca
    $search->setUsername( Utils::getPostParam('username'));
    $search->setPassword(Utils::getPostParam('password'));
    $result = $userDao->find($search);
    if(count($result) > 0 ){
      $utente = $result[0];
    }else{
      if(!$exit)
        Flash::addFlash('Username e Password non validi');
      $exit = true;
    }
} else {
    if(!$exit && array_key_exists('login', $_POST))
        Flash::addFlash('Username e Password Obbligatori');
    $exit = true;
}
if(!$utente || $utente->getAttivo() == Utente::UTENTE_NON_ATTIVO){
    if(!$exit)
        Flash::addFlash('Utente non valido');
    $exit = true;
}
//carico l'utente in sessione
if(!$exit){
    $_SESSION['user']=$utente;
}

if(isset($_SESSION['user']))
 Utils::redirect('index.php', array('lang' => $_REQUEST['lang'],'page' => 'titoli/listTitoli'));
?>
