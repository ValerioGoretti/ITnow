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

    <div id="app" class="row" style="width: 100%; height: 550px; background-color: #822433;">
        <!--immagine profilo-->
        
            
        <!--riepilogo dati-->
        <div class="dati " style="background-color: #ffffff;">
            <h2 class="tit font-weight-normal">Dati Studente</h2>
            <div class="row">
            <div class="col" style="text-align: center;">
            <!-- colonna 1-->
            
                <div class="titolo font-weight-normal">Nome</div>
                <div class="line" style=""></div>
                <div class="valore font-weight-normal">{{nome}}</div>
            
            </div>
            <div class="col" style="text-align: center;" >
                
                    <div class="titolo font-weight-normal">Cognome</div>
                    <div class="line" ></div>
                    <div class="valore font-weight-normal">{{cognome}}</div>
                
            </div>
            
            <!-- colonna 2-->
            </div>
            <div class="row">
            <div class="col" style="text-align: center;">
            
                <div class="titolo font-weight-normal">Email</div>
                <div class="line" ></div>
                <div class="valore font-weight-normal">{{email}}</div>


                
            </div>
            <div class="col" style="text-align: center;">

                <div class="titolo font-weight-normal">Matricola</div>
                <div class="line"></div>
                <div class="valore font-weight-normal">{{matricola}}</div>
            
            </div>
            </div>
            <div class="row">
                <div class="col" style="text-align: center;">
                    <a>
                        <div class="btnRegister font-weight-light" style="margin:50px auto;border-radius:6px;padding:5px">Cambia la tua email</div>
                    </a>
                </div>
                <div class="col" style="text-align: center;">
                    <a>
                        <div class="btnRegister font-weight-light" style="margin:50px auto;border-radius:6px;padding:5px">Cambia la tua password</div>
                    </a>
                </div>
            </div>
            
            
            
       
        

          
        
        </div>

        
        
        </div>
    
        
    

    
    
    
    <?php include 'profilo_studente.php';?>
    </body>
</html>