
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
                    
                    include "updateStudentiJson.php";                    
                    if(isset($_GET['res'])){
                    $nome=$_GET['nome'];
                    $cognome=$_GET['cognome'];
                    $email=$_GET['email'];
                    $password=$_GET['password']; 
                    $matricola=(int)$_GET['matricola'];
                    $data=$_GET['data'];
     
         
                     $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
   
                     $array=array('matricola' => $matricola,'nome'=>$nome,'password'=>md5($password),'cognome'=>$cognome,'email'=>$email,'anno'=>1998, 'data_nascita'=>$data);
                     $result = pg_insert($dbconn,'studente',$array) or die ('Query failed: '.pg_last_error());
                    
                    if($result) 
                        {run2(); 
                            echo('<div class="row" style="width:fit-content; margin:0 auto;">');
                            echo('<p style="font-size:25px ;padding:10px class="font-weight-bold" >Ciao '.$nome.' ,</p>');   
                            echo('</div>');
                            echo('<p style="font-size:20px ;padding:10px" class="font-weight row" >benvenuto in Itnow! Effettua il login per entrare nel portale.</p>');
                            $originale = 'assets/img/utente.png';
                            $copia = "img_docente/$email.png";
                            copy($originale,$copia);
                        }
                    else{
                            echo('<p style="font-size:20px ;padding:10px" class="font-weight row" >Registrazione non riuscita , per favore riprovare.</p>');
                    } 
                    pg_close($dbconn);}
                    
                ?>
                 
                  <a class="row" style="color:white; width:fit-content; padding: 8px; border-radius: 6px; background-color:#822433; margin:0 auto; margin-top: 50px;"href="index.html#login">Torna al login</a>
                    
                </div>
                  
                

            </div>
            
        </div>
        </div>

    
    </body>
</html>
