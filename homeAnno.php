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
                
                
                $('#iconaCode').click(function(){
                    $('#textCode').toggle();
                    setTimeout(function(){
                    readOnlyCodeMirror.refresh();},2);
                    
                 
                });        
            });
        </script>
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
                        include 'vedi-notifiche.php';
                        pareggiaVisite($corso,$dbconn2);
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
                            "SELECT ad.id as annod_id, ad.corso, ad.anno,post.id as idpost, post.intestazione, post.testo, post.data, post.codice, post.linguaggio, d.nome, d.cognome, d.email
                            from anno_didattico as ad join post on ad.id=post.anno join docente as d on post.docente=d.email  
                            where ad.id='$corso' 
                            order by post.id desc ";
                            $result = pg_query($dbconn2,$query) or die ('Query failed: '.pg_last_error());

                            
                            while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC)){
                                $idpost=$line['idpost'];
                                $linguaggio=$line['linguaggio'];

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
                                <div class="testoPost"><?php echo $line['testo'];?> <br><br>
                                <?php $i=$line['idpost'];if($line['codice']!= null and $line['linguaggio']!=null){?>
                                        
                                        <div id="iconaCode<?php echo $i?>"style="font-size:20px; width:fit-content;cursor:pointer"> <b>Codice Allegato</b>  <i  class="fa fa-code" aria-hidden="true" ></i></div>
                                        <div id="textCode<?php echo $i?>"class="animate slideIn"><div style="background-color:#282a36; color:#fff; width:100px; text-align:center" id="ling<?php echo $i?>" ><?php echo $line['linguaggio']; ?></div> <textarea name="editor" id="editor<?php echo $i?>" style="resize: none" readonly> <?php echo $line['codice'] ?></textarea></div>
                                        
                                        <script> creaCodeMirror("ling<?php echo $i?>","editor<?php echo $i?>");
                                                 $('#iconaCode<?php echo $i?>').click(function(){
                                                         $('#textCode<?php echo $i?>').toggle();
                                                  });
                                                 $('#textCode<?php echo $i?>').hide(); 
                                    </script>
                                    <?php  } ?>
                                </div>
                                
                              
                                
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


        <!-- CHAT -->

        <div id="tondoChat" class="tondoChat grow"><i class="fas fa-comment-dots"></i></div>         
        <div id="chat"class="chat">
            <div class="chatNome"><?php echo $nome." ".$anno?><br><?php echo $docenti?></div>
            <div class="line" style="width:100%;"></div>
            <div style="width:100%;height:78%;overflow:auto;"id="containerMex">
                                      
            </div>
            <span class="inputArea ">
                    <textarea id="testoMessaggio" style="float:left;min-height:40px;width:84%;resize:none;"></textarea>
                    <div id="invia" class="chatbtn" ><i style="margin-top:8px" class="fas fa-paper-plane"></i></div>
            </span>
        </div> 
                        
    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var start=0;
    $('#chat').hide();
    $('document').ready(function(){
        
        window.addEventListener('click', function(e){   
            
            if (document.getElementById('tondoChat').contains(e.target)){
                $('#chat').show();
                var objDiv = document.getElementById("containerMex");objDiv.scrollTop = objDiv.scrollHeight;
                $('#tondoChat').hide();
            } 
            else if (!(document.getElementById('chat').contains(e.target))){
                $('#chat').hide();
                $('#tondoChat').show();
            } 

            });

            
            var mittente = '<?php echo $mittente = $_SESSION['ruolo']=='docente' ?   $_SESSION['email'] :  $_SESSION['matricola']; ?>';
            load();
          
            $('#invia').click(function(){
                    $.ajax({
                            type: "POST",
                            url: "inviaMessaggio.php",
                            data: {testo: $('#testoMessaggio').val(), anno: <?php echo $corso;?>,mittente: mittente},
                            success: function(msg){                             
                            }
                 });
                 $('#testoMessaggio').val('');
            }); 
    });
        
        
    

    function load(){
                $.get("inviaMessaggio.php/?start="+start+"&anno=<?php echo $corso?>",function(ris){
                    ris.forEach(el=>{console.log(el.id);start=el.id;$('#containerMex').append(stampa(el));var objDiv = document.getElementById("containerMex");objDiv.scrollTop = objDiv.scrollHeight;});
                    load();                 
                });
                
                

            }  
    
    function stampa(el){
        var ora=el.timestamp.slice(10,-10);
        var data=el.timestamp.slice(0,10);
        
        var mio = '<?php echo $mittente = $_SESSION['ruolo']=='docente' ?   $_SESSION['email'] :  $_SESSION['matricola']; ?>';
        
        var url='"img_docente/utente.png"';
        if(el.mittente==mio){
            var mex="<div class='messaggio'><div class='immagineMia'><img src='img_docente/"+el.mittente+".png' onerror='this.onerror=null; this.src="+url+"'  style='width: 100%;margin-bottom:40px'></div><div class='textmsgMio'>"+el.testo+"</div><div class='nomeMio'>"+el.nome+"<br><i class='fas fa-clock'></i>"+ora+"&nbsp;&nbsp;&nbsp;<i class='fas fa-calendar'></i>"+data+"</div></div>";
        }
        else{
            var mex="<div class='messaggio'><div class='immagineTua'><img src='img_docente/"+el.mittente+".png'  onerror='this.onerror=null; this.src="+url+"' style='width: 100%;margin-bottom:40px'></div><div class='textmsgTuo'>"+el.testo+"</div><div class='nomeTuo'>"+el.nome+"<br><i class='fas fa-clock'></i>"+ora+"&nbsp;&nbsp;&nbsp;<i class='fas fa-calendar'></i>"+data+"</div></div>";
        }              
        return mex;

    }
</script>