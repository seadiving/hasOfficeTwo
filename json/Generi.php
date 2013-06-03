<?php
 $generi_value = array();
 
 $generiSearch = new GeneriSearchCriteria();
 
if(!isset($_SESSION['generi']) || isset($_SESSION['generi_lang']) && $_SESSION['generi_lang'] != $generiSearch->getLang()){
   
    //definisco la variabile di ricerca dell'utente
    //$genere = $_GET("genere");
    //$generiSearch->setGenere($genere);
    $dao =  new GeneriDao();
    $result = $dao->find(new GeneriSearchCriteria());
    //loop dei dati
    foreach ($result as $genereRes){
        //$row_array['value'] = 
        if($generiSearch->getLang() == 'it'){
            array_push($generi_value,$genereRes->getGenere());
        }else{
           array_push($generi_value,$genereRes->getGenereEng()); 
        }
    }
    if(count($generi_value)>0){
       $_SESSION['generi'] =  $generi_value;
       $_SESSION['generi_lang'] = $_REQUEST['lang'];
       
    }
}

 $generi_value =  $_SESSION['generi'];
 //echo $generi_value[0]["value"];
//restituisco l'array in formato json
//echo json_encode($return_arr);
?>
