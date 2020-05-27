<?php
    function ottieniDati(){
        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
        $query= "select anno_didattico.id as anno_id,corso.nome as nome_corso,corso.descrizione as descrizione_corso, anno_didattico.anno as anno_corso,docente.nome as nome_docente,docente.cognome as cognome_docente,docente.email as email_docente,anno_didattico.stato
        from corso join anno_didattico on corso.nome=anno_didattico.corso join anno_docente on anno_didattico.id=anno_docente.anno join docente on anno_docente.docente=docente.email;";
        $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
        while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC))
            {
                $array[]=array('idCorso'=>$line["anno_id"],'nomeCorso'=>$line["nome_corso"],'descrizioneCorso'=>$line['descrizione_corso'],'anno'=>$line['anno_corso'],'nomeDoc'=>$line['nome_docente'],'cognomeDoc'=>$line["cognome_docente"],'emailDoc'=>$line["email_docente"],'stato'=>$line['stato']);
            }
        return json_encode($array);
    }

    function run(){
        file_put_contents("json/corsi.json",ottieniDati());
    }


?>