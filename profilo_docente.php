<?php
    
    $email=$_SESSION['email'];
    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    $query= "SELECT * FROM docente where email='$email'";
    $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
    $nome;    $cognome;    $email;   $data_nascita;
    while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC))
    {
        $nome=$line['nome'];
        $cognome=$line['cognome'];
        $email=$line['email'];
        $data_nascita=$line['data_nascita'];
    }
?>

<script>
    var app=new Vue(
        {
            el:'#ap',
            data:{
                    nome:'<?php echo $nome?>',
                    cognome:'<?php echo $cognome?>',
                    email:'<?php echo $email?>',             
                    data_nascita:'<?php echo $data_nascita?>'   
            }

        }
    );
</script>
 
