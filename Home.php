<?php
    session_start();
    $logged=isset($_SESSION['logged']);
    $matricola=($_SESSION['matricola']);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="css/home.css" rel="stylesheet">
        <title></title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- Third party plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script>
            
            var logged=('<?php echo $logged ?>'=='1');

            if (!logged)
            {
                alert("sessione scaduta,eseguire il login");
                $(window.location).attr('href',"index.html#login");

            }

            $("document").ready(function(){
                $('#documenti').hide();             
            });
            
        </script>
    </head>
    <body>
        <?php include 'header.php'?>
                     
        
        <div class="leftBar "> <p>ciao </p></div>
        <div class="rightBar"> barra dx</div>
        <div class="core ">
            <div class="spazioPost">
            <?php       include "updatePost.php";
                        run($matricola);
                        $string=file_get_contents('json/post.json', 'r');
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
                                <div class="doc"><div ><?php echo '<p style="background-color:#822433; color:white;">'.$p['timestamp']."</p>";?></div> </div>
                            </div>
                                <?php } ?>
                                
            </div>
        </div>   
        
    </body>
</html>