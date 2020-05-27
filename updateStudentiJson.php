<?php
function ottieniDati2(){
$dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
$query= "SELECT * FROM studente";
$result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC))
{
    $array[]=array('mail'=>$line['email'],'matricola'=>$line['matricola']);
}

pg_close($dbconn);
return json_encode($array);
}
function run2(){
$file_name='registrazione.json';

file_put_contents("json/dati_studenti.json",ottieniDati2());

}

?>