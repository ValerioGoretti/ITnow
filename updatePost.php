<?php
    function ottieniDati($matricola){
        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
        $query= 
        "SELECT ad.id, ad.corso, ad.anno,post.id as idpost, post.intestazione, post.testo, post.timestamp, d.nome, d.cognome, d.email
        from anno_didattico as ad join post on ad.id=post.anno join docente as d on post.docente=d.email join studente_corso as st on post.anno=st.anno
        where st.studente=$matricola
        order by post.timestamp asc
        ";
        $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
        while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC)){
                $array[]=array('idCorso'=>$line['id'],'corso'=>$line["corso"],'anno'=>$line['anno'],'idpost'=>$line['idpost'],'titolo'=>$line['intestazione'],'testo'=>$line['testo'],'timestamp'=>$line['timestamp'],'nomeDoc'=>$line["nome"],'cognomeDoc'=>$line["cognome"],'emailDoc'=>$line["email"]);
            }
        return json_encode($array);
    }
 
    function run($matricola){
        file_put_contents("json/post.json",ottieniDati($matricola));
    }

?>