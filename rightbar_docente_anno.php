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

<div class="rightBar" style="padding:10px;">
    <div class="btn-follow follow"><?php if(!($follow=="")) echo $follow?></div>
    
    <div class="addColl"><h7>Aggiungi un collaboratore</h6></div>
    <form action="aggiungiCollaboratore.php" method="get">
        <input type="text" name="collaboratore" class="insertCollab" placeholder="Inserisci email collaboratore" required>
        <input type="hidden" name="corso" value="<?php echo $corso; ?>">
        <input type="submit" class="aggiungi" value="Aggiungi" style="margin-top:5%; width:50%; float:right">
    </form><br>

   <?php
        $query10="SELECT docente.email, collaboratori.anno_didattico as anno
                FROM collaboratori join docente on collaboratori.email=docente.email
                where collaboratori.anno_didattico=$corso";
        $result10 = pg_query($dbconn,$query10) or die ('Query failed: '.pg_last_error());
        
   ?>

    <div class="addColl"><h7>Elimina un collaboratore</h6></div>
    <form action="EliminaCollaboratore.php" method="get">
        <select style="width:100%; border-radius:10px; padding 10px;outline:none" id="collaboratore" name="collaboratore" required>
        <?php while ($line  = pg_fetch_array($result10,null,PGSQL_ASSOC)){?>
            <option> <?php echo $line['email'];?> </option>
            <?php }?>
        </select>
        <input type="hidden" name="corso" value="<?php echo $corso; ?>">
        <input type="submit" class="aggiungi" value="Rimuovi" style="margin-top:5%; width:50%; float:right">
    </form>
</div>
