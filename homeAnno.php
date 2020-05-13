<?php
    include 'updatePost.php';
    run();
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
               
               
                $('.follow').click(function(){
                    if ($('.follow').text() =='Segui') 
                    {    $('.follow').text('Non seguire più');}
                    else 
                    {    $('.follow').text('Segui');}
                });
            });
        </script>
    </head>
    <body>
        <div class="header row">
            <div class="col-2"  style="text-align:center" ><a href="index.html" ><img style="width:130px;height:130px;" src="/LOGHI/logo_con_testo_accanto_bordeaux.png"></img></a></div>
            <div class="ricerca col">  
                <form action="profiloCorso.php" method="get" name="corsoform">
               
                <!--<input type="text" class="testo" placeholder="cerca qui" id="r">-->
                <input  type="text" placeholder="cerca un corso" autocomplete="off" list="corso" name="corso" class="testo" id="r" onchange="document.corsoform.submit();"/>
                
                <datalist id="corso" style="width:100%">
                    <?php   
                            $string=file_get_contents('json/corsi.json', 'r');
                            $corsi=json_decode($string,true);
                            $no_dup =[];
                            foreach($corsi as $c){
                                if(!in_array($c['nomeCorso'],$no_dup))
                                {?>
                                    <option value="<?php echo $c['nomeCorso'] ?>"><?php echo $c['nomeCorso'] ?></option>
                                    <?php array_push($no_dup,$c['nomeCorso']);
                            }}?>
                </datalist>
                </form>
            </div>
            
            <div class="profile " ><a href="profilo.html" style="text-decoration: none; color: #fff;"><i class="fas fa-user" ></i></a></div>
        </div>
                     
        
        <div class="leftBar "> <p>ciao </p></div>
        <div class="rightBar" style="padding:10px;">  <div class="btn-follow follow">Segui</div></div>
        <div class="core ">
            <div class="spazioPost">
            <?php 
                        $corso = $_GET['corso'];
                        $string=file_get_contents('json/post.json', 'r');
                        $post=json_decode($string,true);
                        foreach ($post as $p){
                            if($p['idCorso']==$corso){?>
                          
                            <div class="post">
                                <div class="titolo"> <h2><?php echo $p['titolo'];?></h2> </div>
                                <div class="autore"><h5><?php echo $p['nomeDoc'] . ' '.$p['cognomeDoc'];?></h5> </div>
                                <div class="linea"><div class="line"></div></div>
                                <div class="testoPost"><?php echo $p['testo'];?> </div>
                                <div class="doc"> <div class="attache"><i class="fas fa-paperclip"></i></div></div>
                                <div class="data"><div ><?php echo '<p style="background-color:#822433; color:white;">'.$p['timestamp']."</p>";?></div> </div>
                            </div>
                                <?php }} ?>
            </div>
        </div>   
        
    </body>
</html>