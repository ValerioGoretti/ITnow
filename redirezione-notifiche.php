<?php
if (isset($_GET['id']) && (isset($_GET['studente']))) {

    $anno = $_GET['id'];
    $studente = $_GET['studente'];
    $incremento = $_GET['incremento'];
    echo $incremento;
    $conn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    $q = "UPDATE notifiche SET visti=visti+$incremento where studente='$studente' and anno='$anno'";
    $r = pg_query($conn, $q);
    if ($r) {
        header("Location: homeAnno.php?corso=$anno");
    }
}
?>