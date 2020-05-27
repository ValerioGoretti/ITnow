<?php
    
   
    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    if($_GET['stato']=='follow')
    {
                     $array=array('studente'=>$_GET['studente'],'anno'=>$_GET['id']);   
                     $result = pg_insert($dbconn,'studente_corso',$array) or die ('Query failed: '.pg_last_error());
    }
    if($_GET['stato']=="unfollow")
    {
                    $array=array('studente'=>$_GET['studente'],'anno'=>$_GET['id']);
                    $result=pg_delete ($dbconn,'studente_corso',$array) or die ('Query failed: '.pg_last_error());

    }
    
    pg_close($dbconn);
?>