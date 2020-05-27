<?php

    $corso = $_GET['corso'];
    $doc=$_GET['collaboratore'];
    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");

    $query4="DELETE FROM collaboratori
	         WHERE email='$doc'";
    $result4=pg_query($dbconn,$query4) or die ('Query failed: '.pg_last_error());
    
    header("Location: HomeAnno.php?corso=$corso&messaggio=Collaboratore eliminato correttamente");
    

?>