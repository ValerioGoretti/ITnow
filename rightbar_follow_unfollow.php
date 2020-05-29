<?php
                        
                       
                        
                        $follow;
                        $corso = $_GET['corso'];
                        $matricola=$_SESSION['matricola'];
                        $docenti="";
                        $anno;
                        $nome;
                        $mail="";
                        $dbconn2 = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
                        $query2= 
                            "SELECT anno_didattico.anno,docente.nome,docente.cognome,docente.email,anno_didattico.corso
                            from anno_docente join anno_didattico on anno_docente.anno=anno_didattico.id join docente on anno_docente.docente=docente.email
                            where anno_didattico.id='$corso' 
                            ";
                            $result2 = pg_query($dbconn2,$query2) or die ('Query failed: '.pg_last_error());
                            while ($line  = pg_fetch_array($result2,null,PGSQL_ASSOC)){
                                    $docenti=$line["nome"]." ".$line['cognome']." ".$docenti;
                                    $anno=$line["anno"];
                                    $nome=$line["corso"];
                                    $mail=$line["email"]." ".$mail;

                            }
                        $query3=   
                        "SELECT *
                        from studente_corso
                        where studente='$matricola' and anno='$corso'
                        ";
                        $result3 = pg_query($dbconn2,$query3) or die ('Query failed: '.pg_last_error());
                        if(pg_num_rows($result3)==1){$follow='Non seguire più';}
                        else{$follow='Segui';}

                        
?>
<script>
$("document").ready(function(){
                
               
                $('.follow').click(function(){
                    if ($('.follow').text() =='Segui') 
                    {   
                             $.ajax({
                            type: "GET",
                            url: "follow-unfollow.php",
                            data: {stato:'follow',id:'<?php echo $corso;?>',studente:'<?php echo $matricola;?>'},
                            success: function(msg){
                            location.reload();
                            console.log(msg);                              
                            }
                 });  
                            }
                    else 
                    {    
                             $.ajax({
                            type: "GET",
                            url: "follow-unfollow.php",
                            data: {stato:'unfollow',id:'<?php echo $corso;?>',studente:'<?php echo $matricola;?>'},
                            success: function(msg){
                                
                                location.reload();
                                console.log(msg);
                                }
                 });
                    }
                });
            });
 </script>
        
<div class="rightBar" style="padding:10px; height:fit-content;"><div class="btn-follow follow"><?php echo $follow?></div>



</div>