<?php
                        
                       
                        $follow="";
                        $corso = $_GET['corso'];
                        $docente=$_SESSION['email'];
                        $dbconn2 = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
                        $query3=   
                        "SELECT stato
                        from anno_didattico join anno_docente as ad on ad.anno=anno_didattico.id 
                        where id='$corso' and ad.docente='$docente'
                        ";
                        $result3 = pg_query($dbconn2,$query3) or die ('Query failed: '.pg_last_error());
                        while ($line  = pg_fetch_array($result3,null,PGSQL_ASSOC))
                        {
                            $follow=$line['stato'];
                           
                        }
                        if ($follow=='In corso')$follow='Termina corso';
                        if ($follow=='Terminato')$follow='Riapri il corso';
                        
                        

?>
<script>
$("document").ready(function(){
                
               
                $('.follow').click(function(){
                    if ($('.follow').text() =='Termina corso') 
                    {   
                             $.ajax({
                            type: "GET",
                            url: "termina-attiva.php",
                            data: {stato:'follow',id:'<?php echo $corso;?>'},
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
                            url: "termina-attiva.php",
                            data: {stato:'unfollow',id:'<?php echo $corso;?>'},
                            success: function(msg){
                                
                                location.reload();
                                console.log(msg);
                                }
                 });
                    }
                });
            });
 </script>

<div class="rightBar" style="padding:10px;"><div class="btn-follow follow"><?php if(!($follow=="")) echo $follow?></div></div>
