<?php
    
   
    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    if($_GET['stato']=='follow')
    {
                     $array=array('studente'=>$_GET['studente'],'anno'=>$_GET['id']);
                     $anno=$_GET['id'];
                     $studente=$_GET['studente'];
                     $risultatoConto=pg_query($dbconn, "SELECT MAX(id)
                                                        FROM public.post
                                                        where anno='$anno';");
                                                    
                     $lastId;
                     while ($line  = pg_fetch_array($risultatoConto,null,PGSQL_ASSOC))
                    {
                        $lastId=$line['max'];
                    }
                     if($lastId=='') $lastId=0;
                     $resultNotifica=pg_query($dbconn, "INSERT INTO notifiche(studente,anno,visti) values($studente,$anno,$lastId)");
                     $result = pg_insert($dbconn,'studente_corso',$array) or die ('Query failed: '.pg_last_error());
                     echo $resultNotifica;
    }
    if($_GET['stato']=="unfollow")
    {
                    $array=array('studente'=>$_GET['studente'],'anno'=>$_GET['id']);
                    $result=pg_delete ($dbconn,'studente_corso',$array) or die ('Query failed: '.pg_last_error());
                    $anno=$_GET['id'];
                    $studente=$_GET['studente'];
                    $resultNotifica=pg_query($dbconn, "DELETE FROM notifiche WHERE studente='$studente' and anno='$anno'");
                    echo $resultNotifica;

    }
    pg_close($dbconn);
    
?>