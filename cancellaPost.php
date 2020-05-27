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

    //RIVEDERE LA REDIREZIONE
    header("Location: HomeAnno.php?corso=$id_anno");
    
    pg_close($dbconn);
?>