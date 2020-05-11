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
    </head>
    <body style="width: 100%; height:100%; background-color: #822433;">
    <?php
                $corso = $_GET['corso'];
                $string=file_get_contents('json/corsi.json', 'r');
                $corsi=json_decode($string,true);
    ?>
     <div class="datiCorso" >
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
                    
            
    <?php
                foreach($corsi as $c){
                    //al posto di automi ci va l'imput del form che arriva da home
                    if($c['nomeCorso']==$corso){?>
                        <h5><a class="annoDidattico" href=""> <?php echo $c['nomeCorso'].' '.$c['anno'] .'-'. $c['nomeDoc'].' '. $c['cognomeDoc'].'<br>'; ?></a></h5>
                    <?php }}
     ?> 
                </div>
            </div>
    </body>
</html>