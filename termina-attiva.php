<?php
    
    $dbconn2 = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    
    if($_GET['stato']=='follow')
    {
                     $array=array('id'=>$_GET['id']);
                    $array2=array('stato'=>'Terminato');
                     $result = pg_update($dbconn2,'anno_didattico',$array2,$array) or die ('Query failed: '.pg_last_error());
    }
    if($_GET['stato']=="unfollow")
    {
                    
                    $array=array('id'=>$_GET['id']);
                    $array2=array('stato'=>'In corso');
                     $result = pg_update($dbconn2,'anno_didattico',$array2,$array) or die ('Query failed: '.pg_last_error());

    }
?>