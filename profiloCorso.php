<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/registrazione.css">
        <link href="css/profilo.css" rel="stylesheet" />
        <link href="css/profilo.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet"/>
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

        
    </head>
    <body >
    <?php include 'header.php'?>
    <div style="width: 100%; height:100%; background-color: #822433; padding:3px" > 
    <?php
                $corso = $_GET['corso'];
                $string=file_get_contents('json/corsi.json', 'r');
                $corsi=json_decode($string,true);
    ?>
     <div class="datiCorso">
            <h2 class="tit"> <?php echo $corso?> </h2>
            
            <?php
                foreach($corsi as $c){
                    //al posto di automi ci va l'imput del form che arriva da home
                    if($c['nomeCorso']==$corso){?>
                       <div class="descrizione"> <?php echo $c['descrizioneCorso']?></div>
                       
                    <?php break;}}
     ?> 
            <h2 class="tit">Anni didattici del corso</h2>
            
       
            <div class="anni">
                    
            <form action="homeAnno.php" method="get" name="homeAnno">
    <?php
                foreach($corsi as $c){
                    if($c['nomeCorso']==$corso){?>
                            <button type="hidden" class="annoDidattico" value="<?php echo $c['idCorso']?>" name="corso"> <h5><?php echo $c['nomeCorso'].' '.$c['anno'] .'-'. $c['nomeDoc'].' '. $c['cognomeDoc']; ?></h5> </button><br>
                    <?php }}
     ?> 
                </form>
                </div>
            </div>
    </div>
    </body>
</html>