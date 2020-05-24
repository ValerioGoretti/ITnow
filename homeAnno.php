<?php session_start(); 
    $corso = $_GET['corso'];
    $dbconn2 = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    $docenti="";
                        

                        $matricola;
                        $anno;
                        $stato;
                        $nome;
                        $mail="";
                        $dbconn2 = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
                        $query2= 
                            "SELECT anno_didattico.anno,anno_didattico.stato,docente.nome,docente.cognome,docente.email,anno_didattico.corso
                            from anno_docente join anno_didattico on anno_docente.anno=anno_didattico.id join docente on anno_docente.docente=docente.email 
                            where anno_didattico.id='$corso' 
                            ";
                            $result2 = pg_query($dbconn2,$query2) or die ('Query failed: '.pg_last_error());
                            while ($line  = pg_fetch_array($result2,null,PGSQL_ASSOC)){
                                    $docenti=$line["nome"]." ".$line['cognome']." ".$docenti;
                                    $anno=$line["anno"];
                                    $nome=$line["corso"];
                                    $mail=$line["email"]." ".$mail;
                                    $stato=$line['stato'];
                            }
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
             $("document").ready(function(){
                $('#files').hide();        
            });
        </script>
    </head>
    <body>
        <?php include 'header.php'?>
        
                     
        <?php include 'leftBar.php'?>
      
        <?php if($_SESSION['ruolo']=='studente') include 'rightbar_follow_unfollow.php'?>
        <?php if($_SESSION['ruolo']=='docente') include 'rightbar_docente_anno.php'?>
        <div class="core" style="width:1000px">
       <?php $query= 
                            "SELECT ad.id, ad.corso, ad.anno,post.id as idpost, post.intestazione, post.testo, post.data, d.nome, d.cognome, d.email
                            from anno_didattico as ad join post on ad.id=post.anno join docente as d on post.docente=d.email  
                            where ad.id='$corso' 
                            order by post.id asc ";
                            $result = pg_query($dbconn2,$query) or die ('Query failed: '.pg_last_error());
                            echo "<div class=containerTitolo>";
                            echo "<h3>Benvenuto nella pagina del corso ".$nome."</h3>";
                            echo"<p>Anno del corso: ".$anno."</p>";
                            echo"<p>Docenti del corso: ".$docenti."</p>";
                            echo"<p>Email dei docenti: ".$mail."</p>";
                            echo"<p>Stato del corso: ".$stato."</p>";

                            echo "</div>";
            if($_SESSION['ruolo']=='docente') include 'PannelloDocente.php';?>
            <div class="spazioPost">
            <?php 
                         
                        
                       
                        $query= 
                            "SELECT ad.id as annod_id, ad.corso, ad.anno,post.id as idpost, post.intestazione, post.testo, post.data, d.nome, d.cognome, d.email
                            from anno_didattico as ad join post on ad.id=post.anno join docente as d on post.docente=d.email  
                            where ad.id='$corso' 
                            order by post.id asc ";
                            $result = pg_query($dbconn2,$query) or die ('Query failed: '.pg_last_error());

                            
                            while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC)){
                             //$array[]=array('idCorso'=>$line['id'],'corso'=>$line["corso"],'anno'=>$line['anno'],'idpost'=>$line['idpost'],'titolo'=>$line['intestazione'],'testo'=>$line['testo'],'timestamp'=>$line['timestamp'],'nomeDoc'=>$line["nome"],'cognomeDoc'=>$line["cognome"],'emailDoc'=>$line["email"]);
            
                            ?>

                            <div class="post">
                                <div class="titolo"> <h2><?php echo $line['intestazione'];?></h2> </div>
                                <div class="autore"><h5><?php echo $line['nome'] . ' '.$line['cognome'];?></h5> </div>

                                <?php if($_SESSION['ruolo']=='docente' ){
                                        if($_SESSION['email']==$line['email']){?>
                                            <div class="del"> <a href="cancellaPost.php?post=<?php echo $line['idpost'] ?>&annod_id=<?php echo $line['annod_id']?>"><i class="fas fa-trash-alt" style="margin-right:10%"></i></a></div>
                                        <?php if($_SESSION['email'] != $line['email']){?>
                                            <div class="del"></div>
                                        
                                <?php }}}
                                    else{?>
                                        <div class="del"></div>
                                    <?php }?>


                                <div class="linea"><div class="line"></div></div>
                                <div class="testoPost"><?php echo $line['testo'];?> </div>

                                <div class="data">
                                <?php
                                        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
                                        $query= "select post.id as postid, file.id,  file.url, file.name
                                        from post join file on post.id=file.post
                                        where post.id=$1;";
                                        $result = pg_query_params($dbconn,$query,array($line['idpost'])) or die ('Query failed: '.pg_last_error());
                                        while ($linefile  = pg_fetch_array($result,null,PGSQL_ASSOC)){ ?>
                                                <a href="<?php echo $linefile['url'];?>" download="<?php echo $linefile['name']; ?>" style="text-decoration:none"><div class="attache"><?php echo $linefile['name']; ?> <i class="fas fa-paperclip"></i></div></a>
                                      <?php 
                                        }?>
                                </div>
                                <div class="doc"><?php echo $line['data'];?></div>
                            </div>
                                <?php } ?>
            </div>
           
        </div>
       
        
    </body>
</html>