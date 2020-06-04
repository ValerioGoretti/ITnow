<?php
//codice php relativo all'aggiornamento del file json contentente i dati dei docenti già presenti
//per i controlli della registrazione
function ottieniDatiDoc(){
$dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
$query= "SELECT * FROM docente";
$result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
$array=array();
while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC))
{
    $array[]=array('mail'=>$line['email']);
}
return json_encode($array);
}
function runDoc(){
$file_name='registrazione.json';

file_put_contents("json/dati_docenti.json",ottieniDatiDoc());
}


?>