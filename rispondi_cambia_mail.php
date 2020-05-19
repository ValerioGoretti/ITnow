<?php
    
    
    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    if(isset($_GET['email']))
    {
        $array=array('email'=>$_GET['email']);
        $condition=array('matricola'=>$_GET['studente']);
        $res=pg_update($dbconn,'studente',$array,$condition)or die ('Query failed: '.pg_last_error());
        if ($res) echo'Email cambiata con successo';
        else echo 'Non è stato possibile cambiare la mail, riprovare per favore';
    }
?>