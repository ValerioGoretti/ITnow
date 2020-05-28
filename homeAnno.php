<?php session_start();  
      
      function eliminaVirgola($stringa){
        return substr($stringa, 0, strlen($stringa)-2);
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

        <!--Code-->
                <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
                    <script src="/codemirror/lib/codemirror.js"></script>
                    <link href="/codemirror/lib/codemirror.css" rel="stylesheet">
                    <script src="/codemirror/mode/xml/xml.js"></script>
                    <script src="/codemirror/mode/python/python.js"></script>
                    <script src="/codemirror/mode/css/css.js"></script>
                    <script src="/codemirror/mode/javascript/javascript.js"></script>
                    <script src="/codemirror/mode/php/php.js"></script>
                    <script src="/codemirror/mode/sql/sql.js"></script>
                    <script src="/codemirror/mode/vue/vue.js"></script>
                    <script src="/codemirror/addon/edit/closebrackets.js"></script>
                    <script src="/codemirror/addon/edit/closetag.js"></script>
                    <link href="/codemirror/theme/dracula.css"  rel="stylesheet">
                    <title>ProvaCodeMirror</title>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    
                    
    </head>
    <body>
        <?php include 'header.php'?>                     
        <?php include 'leftBar.php'?>
        <?php include 'right-bar-control2.php';?>
        
        
        
        <div class="core" style="width:1000px">
  
                <div class="spazioPost">
                <?php 
                        $docenti="";
                        $matricola;
                        $anno;
                        $stato;
                        $nome;
                        $mail="";
                        
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

                    <?php $query= 
                                            "SELECT ad.id, ad.corso, ad.anno,post.id as idpost, post.intestazione, post.testo, post.data, d.nome, d.cognome, d.email
                                            from anno_didattico as ad join post on ad.id=post.anno join docente as d on post.docente=d.email  
                                            where ad.id='$corso' 
                                            order by post.id desc ";
                                            $result = pg_query($dbconn2,$query) or die ('Query failed: '.pg_last_error());
                                            echo "<div class=containerTitolo>";
                                            echo "<h3>Benvenuto nella pagina del corso ".$nome."</h3>";
                                            echo"<p>Anno del corso: ".$anno."</p>";
                                            echo"<p>Docenti del corso: ".$docenti."</p>";
                                            ?>
                                            
                                            <?php
                                            $query6="SELECT docente.email,nome,cognome, anno_didattico
                                                     FROM collaboratori join docente on collaboratori.email=docente.email
                                                     where anno_didattico=$corso;";
                                            $collaboratori="";
                                             $result6 = pg_query($dbconn2,$query6) or die ('Query failed: '.pg_last_error());
                                             while ($coll  = pg_fetch_array($result6,null,PGSQL_ASSOC)){
                                                     $collaboratori=$collaboratori.$coll['nome'].' '.$coll['cognome'].', ';
                                              }
                                            $collaboratori=eliminaVirgola($collaboratori);
                                            echo"<p>Collaboratori del corso: ".$collaboratori."</p>"; 
                                            echo"<p>Email dei docenti: ".$mail."</p>";
                                            echo"<p>Stato del corso: ".$stato."</p>";

                                            echo "</div>"; ?>
                </div>
            


           <?php if($_SESSION['ruolo']=='docente'){ 
                 $query8="SELECT docente.email, collaboratori.anno_didattico as anno
                        FROM collaboratori join docente on collaboratori.email=docente.email
                        where collaboratori.anno_didattico=$corso
                                             Union
                        SELECT docente.email, anno_docente.anno
                        From docente join anno_docente on anno_docente.docente=docente.email join anno_didattico on anno_docente.anno=anno_didattico.id
                        where  anno_docente.anno=$corso  ";

                $result8= pg_query($dbconn2,$query8) or die ('Query failed: '.pg_last_error());
                while ($lin  = pg_fetch_array($result8,null,PGSQL_ASSOC)){
                     if($lin['email']==$_SESSION['email'] and $stato=='In corso'){
                        include 'PannelloDocenteCorso.php';
                     }
                }
               
               }?>


                <div class='row'>                            
                <p class="font-weight-light" style="margin-left:140px;font-size:40px;">Post del corso</p>
                <div class="line2" style="width:500px"></div>
                </div>
            <div class="spazioPost" >
            <?php 
                        
                        $query= 
                            "SELECT ad.id as annod_id, ad.corso, ad.anno,post.id as idpost, post.intestazione, post.testo, post.data, d.nome, d.cognome, d.email
                            from anno_didattico as ad join post on ad.id=post.anno join docente as d on post.docente=d.email  
                            where ad.id='$corso' 
                            order by post.id desc ";
                            $result = pg_query($dbconn2,$query) or die ('Query failed: '.pg_last_error());

                            
                            while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC)){
                                $idpost=$line['idpost'];

                            ?>

                            <div class="post">
                                <div class="titolo"> <h2><?php echo $line['intestazione'];?></h2> </div>
                                <div class="autore"><h5><?php echo $line['nome'] . ' '.$line['cognome'];?></h5> </div>
                                
                                <?php 
                                        if($_SESSION['ruolo']=='docente' and $_SESSION['email']==$line['email']){?>
                                            <div class="del"><a href="cancellaPost.php?post=<?php echo $line['idpost'] ?>&annod_id=<?php echo $corso ?>"><i class="fas fa-trash-alt" style="margin-right:10%; text-decoration:none; color:black;"></i></a></div>
                                        <?php }?>
                                        <?php if(!($_SESSION['ruolo']=='docente' and $_SESSION['email']==$line['email'])){?>
                                            <div class="del"></div>
                                        <?php }?>
                                <div class="linea"><div class="line"></div></div>
                                <div class="testoPost"><?php echo $line['testo'];?> </div>
                                
                              
                                
                                <div class="doc"><?php echo $line['data'];?></div>




                                <div class="data">
                                    <?php
                                        $query8="select post.id , file.id,  file.url, file.name
                                        from post join file on post.id=file.post
                                        where post.id=$idpost;";
                                        $result8 = pg_query($dbconn2,$query8) or die ('Query failed: '.pg_last_error());
                                        while ($linefile  = pg_fetch_array($result8,null,PGSQL_ASSOC))
                                        { ?>
                                                       <a href="<?php echo $linefile['url'];?>" download="<?php echo $linefile['name']; ?>" style="text-decoration:none"><div class="attache"><?php echo $linefile['name']; ?> <i class="fas fa-paperclip"></i></div></a>    
                                         <?php }
                                    ?>
                                </div>










                            </div>
                                <?php } 
                            pg_close($dbconn2);

                                ?>
            </div>
           
        </div>
       
        
    </body>
</html>