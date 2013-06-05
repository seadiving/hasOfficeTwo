<?php
date_default_timezone_set('Europe/Rome');


setlocale(LC_ALL, 'en');

if(!isset($_REQUEST['lang']))
    $_REQUEST['lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

$lang = $_REQUEST['lang'];




function __($str) {
return($str);
}

if (!isset($lang) or ($lang == "it")) {
	$yes = "si";
	$no = "no";
	$back = "indietro";
	$cerca = "cerca";
	$searchKey = "parola chiave di ricerca";
	$signIn = "Fai login";
}


if ($lang == "en") {
        $yes = "si";
	$no = "no";
	$back = "back";
	$cerca = "search";
	$searchKey = "insert a keyword";
	$signIn = "Please sign in";

}



?>