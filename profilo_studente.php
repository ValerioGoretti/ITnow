<?php
    //codice php incluso in profilo.php per la visualizzazione dei dati studenti

    
    $matricola=$_SESSION['matricola'];
    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    $query= "SELECT * FROM studente where matricola='$matricola'";
    $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
    $nome;   $cognome;   $matricola;   $email; $data;

    while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC))
    {
        $nome=$line['nome'];
        $cognome=$line['cognome'];
        $matricola=$line['matricola'];
        $email=$line['email'];
        $data=$line['data_nascita'];
    }

?>

<script>
    var app=new Vue(
        {
            el:'#app',
            data:{


                    nome:'<?php echo $nome?>',
                    cognome:'<?php echo $cognome?>',
                    email:'<?php echo $email?>',
                    matricola:'<?php echo $matricola?>',
                    data_nascita:'<?php echo $data?>'

            }

        }
    );
</script>
 
