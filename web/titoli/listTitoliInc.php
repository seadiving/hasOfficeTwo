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
$searchTitle = array_key_exists('searchTitle', $_REQUEST)? $_REQUEST['searchTitle']:null;
$searchIsrc = array_key_exists('searchIsrc', $_REQUEST)?$_REQUEST['searchIsrc']:null;//Utils::getUrlParam('search-isrc');
$searchFindFor = array_key_exists('searchFindFor', $_REQUEST)?$_REQUEST['searchFindFor']:null;
$dao = new TitoliDao();
$search = new TitoliSearchCriteria();
if($searchTitle !== null && $searchTitle !== '')
    $search->setTitolo($searchTitle);
if($searchIsrc !== null && $searchIsrc !== '')
    $search->setIsrc($searchIsrc);
if($searchFindFor !== null && $searchFindFor !== '')
    $search->setTipoRicerca($searchFindFor);
//$search->setStatus($status);

// data for template
//$title = Utils::capitalize(' TITOLI');
$result = $dao->find($search);
//echo 'paperino';
$linkPager = $dao->getLinkPager();
//setto le variabili con 


?>

