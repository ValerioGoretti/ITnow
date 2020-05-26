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
        <div style="background-color: #822433; width: 100%; height: 700px;">
        <div class="row">
            <div class="col-md-6" style="margin:0 auto">
                <div class="container-password" style="height: fit-content;">
                
                <?php
                    
                    include "updateDocentiJson.php";                    
                    if(isset($_GET['doc'])){
                    $nome=$_GET['nome2'];
                    $cognome=$_GET['cognome2'];
                     $email=$_GET['email2'];
                    $password=$_GET['p12']; 
                    $data=$_GET['data'];
                   
     
         
                     $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
   
                     $array=array('nome'=>$nome,'password'=>md5($password),'cognome'=>$cognome,'email'=>$email,'data_nascita'=>$data);
   
                     $result = pg_insert($dbconn,'docente',$array);
                     
                    if($result) 
                        {runDoc(); 
                            echo('<div class="row" style="width:fit-content; margin:0 auto;">');
                            echo('<p style="font-size:25px ;padding:10px" class="t font-weight-light" >Ciao '.$nome.' ,</p>');   
                            echo('</div>');
                            echo('<p style="font-size:20px ;padding:10px" class="t font-weight-light row" >benvenuto in Itnow!La moderazione ha convalidato la tua richiesta di iscrizione.Effettua il login per entrare nel portale.</p>');}
                    else{
                            echo('<p style="font-size:20px ;padding:10px" class="font-weight-light row" >Registrazione non riuscita , per favore riprovare.</p>');
                    } 
                    pg_close($dbconn);}
                    else {
                        echo("nope");
                    }
                    
                ?>
                 
                  <a class="row" style="color:white; width:fit-content; padding: 8px; border-radius: 6px; background-color:#822433; margin:0 auto; margin-top: 50px;"href="index.html#login">Torna al login</a>
                    
                </div>
                  
                

            </div>
            
        </div>
        </div>

    
    </body>
</html>
