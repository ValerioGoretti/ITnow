

    <div class="leftBar font-weight-light" id="leftbar"> 
        <div class="ciao" id="titolo">Ciao,<?php echo $_SESSION['nome'] ?></div>
        <div class="ciao" id="corsi">I tuoi corsi:</div>
        <?php     
            if($_SESSION['ruolo']=='studente')
            {
                $mat=($_SESSION['matricola']);
                $query= "select matricola, corso, anno_didattico.anno , docente.nome, docente.cognome, anno_didattico.id
                from studente join studente_corso on studente.matricola=studente_corso.studente 
                join anno_didattico on studente_corso.anno=anno_didattico.id
                join anno_docente on anno_didattico.id=anno_docente.anno join docente on docente.email=anno_docente.docente
                where matricola= '$mat'";
            }

            if($_SESSION['ruolo']=='docente')
            { 
                $email=($_SESSION['email']);
                $query= "select  anno_didattico.anno, anno_didattico.corso, docente.nome, docente.cognome, anno_didattico.id
                        from  anno_didattico join anno_docente on anno_didattico.id=anno_docente.anno join docente on docente.email=anno_docente.docente
                        where email= '$email' and stato='In corso'";
                $query2= "SELECT anno_didattico, anno_didattico.anno, corso, docente , nome, cognome
                          FROM collaboratori join anno_didattico on collaboratori.anno_didattico=anno_didattico.id join anno_docente on anno_docente.anno=anno_didattico.id join docente on anno_docente.docente=docente.email
                          where collaboratori.email='valerio9944@gmail.com' and stato='In corso'";
            }
        
            
            $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
           
            $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
            while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC)){ ?>
                    <a href="homeAnno.php?corso=<?php echo $line['id']; ?>"><div class="leftcard grow" id="leftcard" style="color:black;"> 
                        <div class=materia ><?php echo $line['corso'].' '.$line['anno']?></div>
                        <div class="prof"  ><?php echo $line['nome'].' '.$line['cognome'] ?></div>
                    </div> </a>                   
            <?php }

                $result2 = pg_query($dbconn,$query2) or die ('Query failed: '.pg_last_error());
                if($_SESSION['ruolo']=='docente' and pg_num_rows($result2)>0)
                {
            ?>
            
            <div class="ciao" id="corsi">Le tue colaborazioni sono:</div>
            <?php
            while ($line2  = pg_fetch_array($result2,null,PGSQL_ASSOC)){ ?>
                    <a href="homeAnno.php?corso=<?php echo $line2['anno_didattico']; ?>">
                        <div class2="leftcard grow"  style="color:black;"> 
                            <div class=materia ><?php echo $line2['corso'].' '.$line2['anno']?></div>
                            <div class="prof"  ><?php echo $line2['nome'].' '.$line2['cognome'] ?></div>
                        </div> 
                    </a>                   
             <?php }}?>
    </div>