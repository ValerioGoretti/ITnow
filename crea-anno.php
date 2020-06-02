<?php
if (isset($_GET['docente']) && isset($_GET['data']) && isset($_GET['corso']) && !($_GET['corso'] == 'Corso')) {


    $docente = $_GET['docente'];
    $data = $_GET['data'];

    $anno = substr($data, 0, 4);
    $anno2 = (int)$anno;
    $corso = $_GET['corso'];

    $query = "select  *
                        from  anno_didattico join anno_docente on anno_didattico.id=anno_docente.anno join docente on docente.email=anno_docente.docente
                        where email= '$docente' and corso='$corso' and anno_didattico.anno='$anno2'";


    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");

    $result = pg_query($dbconn, $query) or die ('Query failed: ' . pg_last_error());

    if (pg_num_rows($result) > 0) {
        echo 'Hai gia ha un anno didattico per il corso selezionato!';
    } else {

        $query2 = "INSERT into anno_didattico(anno,corso,inizio) values('$anno2','$corso','$data')RETURNING id;";
        $resulta = pg_query($dbconn, $query2) or die ('Query failed: ' . pg_last_error());
        $id;
        if ($resulta) {
            while ($line = pg_fetch_array($resulta, null, PGSQL_ASSOC)) {
                $id = $line['id'];
                break;
            }
            $array2 = array('anno' => $id, 'docente' => $docente);
            $result2 = pg_insert($dbconn, 'anno_docente', $array2) or die ('Query failed: ' . pg_last_error());
            echo 'Anno didattico creato correttamente!';
        } else {
            echo 'Non è stato possibile creare il corso';
        }
    }
    pg_close($dbconn);

} else {
    echo 'Dati inseriti non validi';
}

?>

