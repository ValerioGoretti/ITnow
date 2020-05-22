<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/password_dimenticata.css">
        <link href="css/registrazione.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />

    </head>
    <body >
                <?php
                    
                    //include "updateDocentiJson.php";                    
                    if(isset($_GET['pubblica'])){
                        $corso=$_GET['corso'];
                        $titolo=$_GET['titolo'];
                        $testo=$_GET['testo'];
                        $file=$_GET['file']; 
                    
        
            
                        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    
                        $array=array('corso'=>$corso,'titolo'=>$titolo,'testo'=>$testo,'file'=>$file);
    
                        $result = pg_insert($dbconn,'post',$array) or die ('Query failed: '.pg_last_error());
                        
                        //devo inserire nella tabella dei file i file e collgarli con l'id
                        if($result) 
                            {}
                        else{                                
                        } 
                        pg_close($dbconn);
                    }
                    
                    
                ?>
                 
                  <a class="row" style="color:white; width:fit-content; padding: 8px; border-radius: 6px; background-color:#822433; margin:0 auto; margin-top: 50px;"href="index.html#login">Torna al login</a>
                    
                </div>
                  
                

            </div>
            
        </div>
        </div>

    
    </body>
</html>
