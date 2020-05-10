<?php
function ottieniDati(){
$dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
$query= "SELECT * FROM studente";
$result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC))
{
    $array[]=array('nome'=>$line["nome"],'cognome'=>$line['cognome'],'mail'=>$line['email'],'matricola'=>$line['matricola']);
}
return json_encode($array);
}
function run(){
$file_name='registrazione.json';

file_put_contents("dati_studenti.json",ottieniDati());

}

?>