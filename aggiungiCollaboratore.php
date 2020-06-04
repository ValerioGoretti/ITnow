<?php
    /*
    Codice php utilizzato per inserire il collaboratore nel DB
    */
    $corso = $_GET['corso'];
    $doc=$_GET['collaboratore'];
    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    error_reporting(E_ERROR | E_PARSE);
    $array4=array('anno_didattico'=>$corso,'email'=>$doc);
    $result4=pg_insert($dbconn,'collaboratori',$array4) ;
    if ($result4) {echo 'Collaboratore inserito correttamente';}
    else{echo 'Non è stato possibile inserire il collaboratore';}
    
    

?>