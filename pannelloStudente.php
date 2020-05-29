<script>function creaCodeMirror(ling,id)
    {
        var lingu = document.getElementById(ling).innerText;
        var readOnlyCodeMirror = CodeMirror.fromTextArea(document.getElementById(id), {
            mode: lingu,
            theme: "dracula",
            lineNumbers: true,
            readOnly: true
        }); 
        readOnlyCodeMirror.setSize("100%","250");
    }
</script>   
<div class='row'>                            
<p class="font-weight-light" style="margin-left:140px;font-size:40px;">Post più recenti</p>
<div class="line2" style="width:450px"></div>
</div>  
<div class="spazioPost">
            <?php       
                        include "updatePost.php";
                        $matricola=($_SESSION['matricola']);
                        run($matricola);
                        $string=file_get_contents('json/post.json', 'r');
                        if(!$string){
                            echo '<div class="containerErrore">';
                            echo'<p style="font-size:20px;" class="font-weight-light">Al momento non ci sono post da mostrare. Per vedere nuovi post, inizia a seguire dei corsi .</p>';
                            echo '</div>';
                        }
                        else{
                        $post=json_decode($string,true);
                        
                        foreach ($post as $p){?>
                                                          
                            <div class="post">
                                <div class="titolo"> <h1><?php echo $p['titolo'];?></h1> </div>
                                <div class="autore"><h3><?php echo $p['nomeDoc'] . ' '.$p['cognomeDoc'].'<br>'.$p['corso'].' '.$p['anno'];?></h3> </div>
                                <div class="linea"><div class="line"></div></div>
                                <div class="testoPost t font-weight-light"><?php echo $p['testo'];?> <br><br>
                                    <?php $i=$p['idpost'];if($p['codice']!= null and $p['linguaggio']!=null){?>
                                        
                                        <div id="iconaCode<?php echo $i?>"style="font-size:20px; width:fit-content;cursor:pointer"> <b>Codice Allegato</b>  <i  class="fa fa-code" aria-hidden="true" ></i></div>
                                        <div id="textCode<?php echo $i?>"class="animate slideIn"><div style="background-color:#282a36; color:#fff; width:100px; text-align:center" id="ling<?php echo $i?>" ><?php echo $p['linguaggio']; ?></div> <textarea name="editor" id="editor<?php echo $i?>" style="resize: none" readonly> <?php echo $p['codice'] ?></textarea></div>
                                        
                                        <script> creaCodeMirror("ling<?php echo $i?>","editor<?php echo $i?>");
                                                 $('#iconaCode<?php echo $i?>').click(function(){
                                                         $('#textCode<?php echo $i?>').toggle();
                                                  });
                                                 $('#textCode<?php echo $i?>').hide(); 
                                    </script>
                                    <?php  } ?>
                                </div>
                                <div class="del"></div>
                                <div class="data">
                                <?php
                                        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
                                        $query= "select post.id as postid, file.id,  file.url, file.name
                                        from post join file on post.id=file.post
                                        where post.id=$1;";
                                        $result = pg_query_params($dbconn,$query,array($p['idpost'])) or die ('Query failed: '.pg_last_error());
                                        while ($linefile  = pg_fetch_array($result,null,PGSQL_ASSOC)){ ?>
                                                <a href="<?php echo $linefile['url'];?>" download="<?php echo $linefile['name']; ?>" style="text-decoration:none"><div class="attache "><?php echo $linefile['name']; ?> <i class="fas fa-paperclip"></i></div></a>
                                      <?php 
                                        }?>
                                </div>
                                <div class="doc font-weight-normal"><?php echo $p['data'];?></div>
                            </div>
                                <?php }} ?>
                                
            </div>
        </div>   
        
<script>
    
    $("document").ready(function(){
        $('#files').hide();    
                
             
    });
 
</script>