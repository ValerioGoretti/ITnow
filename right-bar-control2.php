<?php 
            //codice php relativo alla gestione dello switch rightbar studente/docente in homeAnno.php
            if($_SESSION['ruolo']=='docente') {$dbconn2 = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
            $em=$_SESSION['email'];
            $corso = $_GET['corso'];
            $query10="SELECT docente.email, anno_docente.anno
            From docente join anno_docente on anno_docente.docente=docente.email join anno_didattico on anno_docente.anno=anno_didattico.id
            where  anno_docente.anno='$corso' and email='$em' ";
            $result10 = pg_query($dbconn2,$query10) or die ('Query failed: '.pg_last_error());
            while ($lines  = pg_fetch_array($result10,null,PGSQL_ASSOC)){
                    if($em==$lines['email']){
                        include 'rightbar_docente_anno.php';
                    }
            }}?>

<?php 
    if($_SESSION['ruolo']=='studente') 
    {include 'rightbar_follow_unfollow.php';}
?>