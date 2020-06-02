<?php
$dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
$anno = (isset($_POST['anno'])) ? $_POST['anno'] : $_GET['anno'];

if (!empty($_POST['testo'])) {
    $testo = $_POST['testo'];
    $anno = $_POST['anno'];
    $mittente = $_POST['mittente'];

    session_start();

    $nome = $_SESSION['nome'];
    $array = array('mittente' => $mittente, 'testo' => $testo, 'anno_didattico' => $anno, 'nome' => $nome);
    $result = pg_insert($dbconn, 'chat', $array) or die ('Query failed: ' . pg_last_error());


}

$start = isset($_GET['start']) ? $_GET['start'] : 0;

$q = "SELECT * FROM chat where id>'$start' and anno_didattico='$anno';";
$result2 = pg_query($dbconn, $q);
$array = array();
while ($line = pg_fetch_array($result2, null, PGSQL_ASSOC)) {
    $array[] = $line;

}


pg_close($dbconn);

header("Content-type:application/json");
echo json_encode($array);


?>