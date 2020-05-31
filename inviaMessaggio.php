

<?php
    $testo=$_POST['testo'];
    $anno= $_POST['anno'];
    $mittente= $_POST['mittente'];

    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    $array=array('mittente'=>$mittente,'testo'=>$testo,'anno_didattico'=>$anno);
    $result = pg_insert($dbconn,'chat',$array) or die ('Query failed: '.pg_last_error());

    echo $result;
     
?>