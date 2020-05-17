<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/registrazione.css">
        <link href="css/profilo.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="css/home.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <script type="text/javascript"src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        
</script>
    </head>
    <body>
    <?php include 'header.php';
    session_start();
    $matricola=$_SESSION['matricola'];
    ?>

    <div id="app" style="width: 100%; height: 700px; background-color: #822433;">
        <!--immagine profilo-->
        <div class="immagini">
            <div class="leftBar" style="background-color: #ffffff;"> <p>ciao </p></div>
            <!--
            <div class="circle ">
                <img src="/assets/img/utente.png" style="width: 60%; margin-top: 50px; margin-left: 20%;">
            </div>
            <div class="btn btn-xl btn-primary2 inserimento" >inserisci immagine</div>  
            -->
        </div>
            
        <!--riepilogo dati-->
        <div class="dati" style="background-color: #ffffff;">
            <h2 class="tit">Dati Personali</h2>
            <div class="row" style="padding: 10px; ">
            <div class="col" style="text-align: center;">
            <!-- colonna 1-->
            
                <div class="titolo">Nome</div> <br>
                <div class="line" style="margin-left: 15%;"></div>
                <div class="valore font-weight-normal">{{nome}}</div>
            
        </div>
            <div class="col" style="text-align: center;" >
                
                    <div class="titolo">Cognome</div><br>
                    <div class="line" style="margin-left: 15%;"></div>
                    <div class="valore font-weight-normal">{{cognome}}</div>
                
            </div>
            
            <!-- colonna 2-->
            <div class="col" style="text-align: center;">
            
                <div class="titolo">Email</div><br>
                <div class="line" style="margin-left: 15%;"></div>
                <div class="valore font-weight-normal">{{email}}</div>
                
            </div>
            </div>
            
            
       
        <h2 class="tit">Dati universitari</h2>
        
        <div class="row" style="padding: 10px; ">
        <div class="col" style="text-align: center;" >

        <!-- colonna 1-->   
        <div class="titolo">Matricola</div><br>
        <div class="line" style="margin-top: -5%;  margin-left: 27%;"></div>
        <div class="valore font-weight-normal">{{matricola}}</div>

          
        
        </div>

        <div class="col" style="text-align: center;"  >
        <!-- colonna 3-->  
            <div class="titolo" >Corsi che segui</div><br>
            <div class="line" style="margin-top: -5%; margin-left: 27%;"></div>
            <div class="valore">Corso1<br>Corso2<br>Corso3</div>
        
          </div>
        </div>
        </div>
    </div> 
        
    </div>
</div>
    
    
    
    <?php include 'profilo_studente.php';?>
    </body>
</html>