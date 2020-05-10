<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/registrazione.css">
        <link href="css/profilo.css" rel="stylesheet" />
        <link href="css/profilo.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet"/>

        
    </head>
    <body style="width: 100%; height:100%; background-color: #822433;">
    <?php
        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
        $query ="SELECT *
                 FROM corso JOIN anno_didattico ON corso.nome=anno_didattico.corso
                 WHERE corso.nome='architetture'";
        
        $result = pg_query($query) or die ('Query failed: '.pg_last_error());
    ?>     
    
    
        <!--riepilogo dati-->
        <div class="datiCorso" >
            <h2 class="tit">Nome corso</h2>
            <div class="descrizione">Descrizione del corso</div>
            <h2 class="tit">Anni didattici del corso</h2>
            <div class="anni">
                <?php while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC)){?>
                    <h5><a class="annoDidattico" href=""><?php echo $line['nome'] .' '. $line['anno'];?></a></h5>
                <?php } ?>
            </div>
        </div>
    
    <?php pg_free_result($result);
    pg_close($dbconn);?>
    </body>
</html>