<?php

    
    
    



    
function pareggiaVisite($anno,$dbconn2){
    
    
    if($_SESSION['ruolo']=='studente'){
    $risultatoConto=pg_query($dbconn2, "select *  from post where anno='$anno';");
    $m=$_SESSION['matricola'];                 
    $visti=pg_num_rows($risultatoConto);
    $que="UPDATE notifiche Set visti='$visti' where studente='$m'";
    $r=pg_query($dbconn2,$que);
    
    }




}    
?>