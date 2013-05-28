<?php

require_once '../util/SessionManage.php';

$errors = array();
$titoli = null;
$edit = array_key_exists('id', $_GET);
if ($edit) {
    $titoli = Utils::getTitoloByGetId();
} else {
    // set defaults
    $titoli = new Titoli();
}
//cancel da verificare
if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('detail', array('id' => $titoli->getId()));
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    $data = array(
        //campi caricati
        'brano' => $_POST['titoli']['brano'],
        'autore' => $_POST['titoli']['autore'],
        'editore' => $_POST['titoli']['editore'],
        'esecutore'=> $_POST['titoli']['esecutore'],
        'artista' => $_POST['titoli']['esecutore'],
        'anno' => $_POST['titoli']['anno'],
        'ISRC' => $_POST['titoli']['ISRC'],
        'Sproduzioni_casa' => $_POST['titoli']['sProduzioniCasa'],
        'tipo_prod_titoli' => $_POST['titoli']['tipo_prod_titoli'],
        'Sdurata'=> $_POST['titoli']['minuti'].'-'.$_POST['titoli']['secondi'],
        'proprieta_master' => $_POST['titoli']['proprieta_master'],
        'note' => $_POST['titoli']['note'],
        'descrizione' => $_POST['titoli']['descrizione'],
        'tipo_trattativa' => $_POST['titoli']['tipo_trattativa'],
        'prezzo_base' => $_POST['titoli']['prezzo_base'],
        'cantato' => $_POST['titoli']['cantato'],
        'ID' => $_POST['id'],
    );
        ;
    // map
    TitoliMapper::map($titoli, $data);
    // validate
    $errors = TitoliValidator::validate($titoli);
    // validate
    if (empty($errors)) {
        // save
        $dao = new TitoliDao();
        $titoli = $dao->save($titoli);
        Flash::addFlash('Titolo saved successfully.');
        // redirect
        //Utils::redirect('detail', array('id' => $todo->getId()));
    }
}

?>
