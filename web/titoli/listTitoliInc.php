<?php
require_once '../util/SessionManage.php';
//use Utils;
/*
require_once '../../util/Utils.php';
require_once '../../dao/TitoliDao.php';

require_once '../../util/SessionManage.php';
*/

//$status = Utils::getUrlParam('sSearch');
//TitoliValidator::validateStatus($status);
//echo 'pippo';
$searchTitle = array_key_exists('search-title', $_POST)?$_POST['search-title']:null;//Utils::getUrlParam('search-title');
$searchIsrc = array_key_exists('search-isrc', $_POST)?$_POST['search-isrc']:null;//Utils::getUrlParam('search-isrc');
//echo 'pluto';
$dao = new TitoliDao();
$search = new TitoliSearchCriteria();
if($searchTitle !== null && $searchTitle !== '')
    $search->setTitolo($searchTitle);
if($searchIsrc !== null && $searchIsrc !== '')
    $search->setIsrc($searchIsrc);
//$search->setStatus($status);

// data for template
//$title = Utils::capitalize(' TITOLI');
$result = $dao->find($search);
//echo 'paperino';
$linkPager = $dao->getLinkPager();
//setto le variabili con 


?>

