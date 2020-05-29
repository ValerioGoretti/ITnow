<?php

if(isset($_POST['studente']))

{
    $studente=$_POST['studente'];
    $conn= pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    $postReali=pg_query($conn, "SELECT studente, notifiche.anno as idanno, visti ,count(post.anno), docente.nome, docente.cognome, corso, anno_didattico.anno
    from notifiche LEFT JOIN post on notifiche.anno=post.anno join docente on post.docente=docente.email join anno_didattico on anno_didattico.id=post.anno
    where studente='$studente'
    group by notifiche.anno, notifiche.studente, docente.nome, docente.cognome,anno_didattico.corso,anno_didattico.anno;");
    $output='';
    $contatore=0;
    while ($line  = pg_fetch_array($postReali,null,PGSQL_ASSOC))
    {
        if($line['visti']<$line['count']){
        $visti=$line['visti'];
        $count=$line['count'];
        $nuovi=$count-$visti;
        $corso=$line['corso'];
        $a=$line['anno'];
        $nome=$line['nome'];
        $cognome=$line['cognome'];
        $id=$line['idanno'];
        
        $output.="
                <li>
                <a class='dropdown-item' style='height:70px;' href='redirezione-notifiche.php?id=$id&studente=$studente&incremento=$nuovi'><p><strong>$nuovi nuovi post in:</strong></p><p style='float:right;'>$corso $a<br> $nome $cognome</p></a>
                <div class='line' style='margin-top:5px;width:100%;'></div>
                </li>
                ";
        $contatore++;
        }
        

    }
    if($contatore==0) {$output="
    
    <a class='dropdown-item' style='height:70px;' href='#'><p><strong>Nessun nuovo post</strong></p></a>
    <div class='line' style='margin-top:5px;width:100%;margin-bottom:5px;'></div>
    
    ";}
    $data=array('notifiche'=>$output,
                'contatore'=>$contatore);
    echo json_encode($data);
    
    
    pg_close($conn);






    
}
?>