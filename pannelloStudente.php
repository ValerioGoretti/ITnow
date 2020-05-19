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
                                <div class="titolo"> <h3><?php echo $p['titolo'];?></h3> </div>
                                <div class="autore"><h5><?php echo $p['nomeDoc'] . ' '.$p['cognomeDoc'].'<br>'.$p['corso'].' '.$p['anno'];?></h5> </div>
                                <div class="linea"><div class="line"></div></div>
                                <div class="testoPost t font-weight"><?php echo $p['testo'];?> </div>
                                
                                <div class="data">
                                <?php
                                        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
                                        $query= "select post.id as postid, file.id,  file.url
                                        from post join file on post.id=file.post
                                        where post.id=$1;";
                                        $result = pg_query_params($dbconn,$query,array($p['idpost'])) or die ('Query failed: '.pg_last_error());
                                        while ($linefile  = pg_fetch_array($result,null,PGSQL_ASSOC)){ ?>
                                                <a href="download/prova.txt" download="prova.txt"><div class="attache"><?php echo $linefile['url'] ?> <i class="fas fa-paperclip"></i></div></a>
                                      <?php 
                                        }?>
                                </div>
                                <div class="doc"><?php echo $p['data'];?></div>
                            </div>
                                <?php }} ?>
                                
            </div>
        </div>   