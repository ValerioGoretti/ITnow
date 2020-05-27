<?php
    $corso = $_GET['corso'];
    $doc=$_GET['collaboratore'];
    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
   
    $array4=array('anno_didattico'=>$corso,'email'=>$doc);
    $result4=pg_insert($dbconn,'collaboratori',$array4) or die ('Query failed: '.pg_last_error());
    
    
    

?>