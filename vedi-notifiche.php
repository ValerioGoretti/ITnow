<?php

function pareggiaVisite($anno, $dbconn2)
{


    if ($_SESSION['ruolo'] == 'studente') {
        $risultatoConto = pg_query($dbconn2, "SELECT MAX(id)
        FROM public.post
        where anno='$anno';");
        $lastId;

        while ($line = pg_fetch_array($risultatoConto, null, PGSQL_ASSOC)) {
            $lastId = $line['max'];
        }
        $m = $_SESSION['matricola'];

        $que = "UPDATE notifiche Set visti='$lastId' where studente='$m' and anno='$anno'";
        $r = pg_query($dbconn2, $que);

    }
}

?>