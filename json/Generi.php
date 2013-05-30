<?php
$return_arr = array();

//dati di accesso a mysql e al db
$dbhost = 'YOUR_SERVER';
$dbuser = 'YOUR_USERNAME';
$dbpass = 'YOUR_PASSWORD';
$dbname = 'YOUR_DATABASE_NAME';

//definisco la variabile di ricerca dell'utente
$term = $_GET("term");

//connessione al a mysql
$conn = mysql_connect($dbhost, $dbuser, $dbpass)
or die ('Impossibile connettersi a Mysql');
//selezione ddb
mysql_select_db($dbname);
//se connesso
if ($conn)
{
//query select
$fetch = mysql_query("SELECT * FROM tags WHERE MATCH(tagName) AGAINST('".$term."*')");
//loop dei dati
while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
$row_array['value'] = $row['tagName '];
array_push($return_arr,$row_array);
}

}
//chiudo la connessione a mysql
mysql_close($conn);
//restituisco l'array in formato json
echo json_encode($return_arr);
?>
