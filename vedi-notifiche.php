<?php
   
function pareggiaVisite($anno,$dbconn2){
    
    
    if($_SESSION['ruolo']=='studente'){
        $risultatoConto=pg_query($dbconn2, "SELECT MAX(id)
        FROM public.post
        where anno='$anno';");
<<<<<<< HEAD
        $lastId='';
=======
        $lastId;                                    
>>>>>>> parent of 16f56c7... Formattazione codice

        while ($line  = pg_fetch_array($risultatoConto,null,PGSQL_ASSOC))
        {
        $lastId=$line['max'];
        }
<<<<<<< HEAD
        $m = $_SESSION['matricola'];
        if($lastId!=''){
        $que = "UPDATE notifiche Set visti='$lastId' where studente='$m' and anno='$anno'";
        $r = pg_query($dbconn2, $que);
        }

=======
        $m=$_SESSION['matricola'];                 
       
        $que="UPDATE notifiche Set visti='$lastId' where studente='$m' and anno='$anno'";
        $r=pg_query($dbconn2,$que);
    
>>>>>>> parent of 16f56c7... Formattazione codice
    }
}    
?>