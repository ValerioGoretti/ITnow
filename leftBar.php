<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/home.css" rel="stylesheet">
    </head>
    <body>
        <div class="leftBar" id="leftbar"> 
        <div class="ciao" id="titolo">Ciao,<?php echo $_SESSION['nome'] ?></div>
        <div class="ciao" id="corsi">I tuoi corsi:</div>
        <?php      
            $mat=($_SESSION['matricola']);
            $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
            $query= "select matricola, corso, anno_didattico.anno, docente.nome, docente.cognome
                          from studente join studente_corso on studente.matricola=studente_corso.studente 
                          join anno_didattico on studente_corso.anno=anno_didattico.id
                          join anno_docente on anno_didattico.id=anno_docente.anno join docente on docente.email=anno_docente.docente
                          where matricola= '$mat'";
            $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
            while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC)){ ?>
                    <div class="leftcard" id="leftcard"> 
                        <div class=materia><?php echo $line['corso'].' '.$line['anno']?></div>
                        <div class="prof"><?php echo $line['nome'].' '.$line['cognome'] ?></div>
                    </div>                    
            <?php }?>                          
        </div>
    </body>
</html>