<?php
date_default_timezone_set('Europe/Rome');


setlocale(LC_ALL, 'en');


$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
//$lang = "en_EN";




function __($str) {
return($str);
}

if (!isset($lang) or ($lang == "it")) {
	$yes = "si";
	$no = "no";
	$back = "indietro";
	$cerca = "cerca";
}


if ($lang == "en") {
$yes = "si";
	$no = "no";
	$back = "back";
	$cerca = "search";
}



?>