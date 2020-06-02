<?php
    $idPost=$_GET['post'];
    $id_anno=$_GET['annod_id'];
    $query1="DELETE FROM public.file
             WHERE post=$idPost;";
    
    $query2="DELETE FROM public.post
            WHERE id=$idPost;";
            
    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
        
    $result1 = pg_query($dbconn,$query1) or die ('Query failed: '.pg_last_error());
    $result2 = pg_query($dbconn,$query2) or die ('Query failed: '.pg_last_error());
    if($result1 && $result2){

        $risultatoConto=pg_query($dbconn, "select *  from post where anno='$id_anno';");
        $n_aggiornato=pg_num_rows($risultatoConto);
        $qqq="UPDATE notifiche set visti='$n_aggiornato' where visti>'$n_aggiornato' and anno='$id_anno'";
        pg_query($dbconn,$qqq);


    }
    //RIVEDERE LA REDIREZIONE
    header("Location: HomeAnno.php?corso=$id_anno");
    
?>