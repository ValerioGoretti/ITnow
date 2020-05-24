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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script>

            $("document").ready(function(){
                $('#leftbar').css({"background-color": "#FFFFF0", "color": "#822433"});  
                $('#titolo').css({"color": "#822433"});
                $('#corsi').css({"color": "#822433"});
                $('.leftcard').css({"background-color": "#822433", "color": "#fff"});
            });
            
        </script>
</script>
    </head>
<body style="width:100%; height:110%;">
    <?php include 'header.php';
        session_start();
        
    
    if($_SESSION['ruolo']=='studente'){
        $matricola=$_SESSION['matricola'];?>
        <div id="app" style="background-color:#822433; width:100%; height:100%; padding:3%">
            <!--immagine profilo-->
            
            <div class="barrasinistra" style="background-color:white; width: 20%; float:left;">
                <?php include 'leftBar.php'?>
            </div>   
            <!--riepilogo dati-->

        <div class="immm" style="width: 30%; margin-left:13%;  float:left;">
            <div class="immagini">
                    <div class="circle ">
                        <img src="/assets/img/utente.png" style="width: 60%; margin-top: 50px; margin-left: 20%;">
                    </div>
                    <div class="btn btn-xl btn-primary inserimento"  style="background-color:#fff;color:#822433">inserisci immagine</div>  
                </div>
        </div>
        
        <div class="datii" style="width: 50%; margin-right:-2%; float:right; ">
                <div class="dati" style="background-color: #ffffff;">
                            <h2 class="tit font-weight-normal">Dati Studente</h2>
                            <div class="row">
                    <div class="col" style="text-align: center;">
                            <!-- colonna 1-->
                            
                                <div class="titolo font-weight-normal">Nome</div>
                                <div class="line" style=""></div>
                                <div class="valore font-weight-light">{{nome}}</div>
                            
                            </div>
                        <div class="col" style="text-align: center;" >
                                
                                    <div class="titolo font-weight-normal">Cognome</div>
                                    <div class="line" ></div>
                                    <div class="valore font-weight-light">{{cognome}}</div>
                                
                            </div>
                            
                            <!-- colonna 2-->
                            </div>
                            <div class="row">
                            <div class="col" style="text-align: center;">
                            
                                <div class="titolo font-weight-normal">Email</div>
                                <div class="line" ></div>
                                <div class="valore font-weight-light">{{email}}</div>


                                
                            </div>
                            <div class="col" style="text-align: center;">

                                <div class="titolo font-weight-normal">Matricola</div>
                                <div class="line"></div>
                                <div class="valore font-weight-light">{{matricola}}</div>
                            
                            </div>
                            </div>
                            <div class="row">
                                <div class="col" style="text-align: center;">
                                    <a href="cambia_mail.php" style="text-decoration:none;">
                                        <div class="btnRegister font-weight-light" style="margin:50px auto;border-radius:6px;padding:5px;">Cambia la tua email</div>
                                    </a>
                                </div>
                                <div class="col" style="text-align: center;">
                                    <a href='cambia_password.php' style="text-decoration:none;">
                                        <div class="btnRegister font-weight-light" style="margin:50px auto;border-radius:6px;padding:5px">Cambia la tua password</div>
                                    </a>
                        </div>
                    </div>
                </div>
            
        </div>   
        <?php include 'profilo_studente.php'; 
    } ?>  
    
    




        <!-- PROFILO DOCENTE -->

    <?php if($_SESSION['ruolo']=='docente'){
        $email=$_SESSION['email']; ?>
        <div id="ap" style="background-color:#822433; width:100%; height:100%; padding:3%">
                    <!--immagine profilo-->
                    
                    <div class="barrasinistra" style="background-color:white; width: 20%; float:left;">
                        <?php include 'leftBar.php'?>
                    </div>   
                    <!--riepilogo dati-->

                <div class="immm" style="width: 30%; margin-left:13%;  float:left;">
                    <div class="immagini">
                            <div class="circle ">
                                <img src="/assets/img/utente.png" style="width: 60%; margin-top: 50px; margin-left: 20%;">
                            </div>
                            <div class="btn btn-xl btn-primary inserimento"  style="background-color:#fff;color:#822433">inserisci immagine</div>  
                        </div>
                </div>
                
                <div class="datii" style="width: 50%; margin-right:-2%; float:right; ">
                        <div class="dati" style="background-color: #ffffff;">
                                    <h2 class="tit font-weight-normal">Dati Docente</h2>
                            <div class="row">
                                <div class="col" style="text-align: center;">
                                        <!-- colonna 1-->
                                        
                                            <div class="titolo font-weight-normal">Nome</div>
                                            <div class="line" style=""></div>
                                            <div class="valore font-weight-light">{{nome}}</div>
                                        
                                        </div>
                                    <div class="col" style="text-align: center;" >
                                            
                                                <div class="titolo font-weight-normal">Cognome</div>
                                                <div class="line" ></div>
                                                <div class="valore font-weight-light">{{cognome}}</div>
                                            
                                        </div>
                            </div>
                                    <!-- colonna 2-->
                                    
                                    <div class="row">
                                        <div class="col" style="text-align: center;">
                                        
                                            <div class="titolo font-weight-normal">Email</div>
                                            <div class="line" ></div>
                                            <div class="valore font-weight-light">{{email}}</div>
                                        </div>

                                        <div class="col" style="text-align: center;">
                                        
                                            <div class="titolo font-weight-normal">data nascita</div>
                                            <div class="line" ></div>
                                            <div class="valore font-weight-light">{{data_nascita}}</div>
                                        </div>

                                        
                                    </div>

                                    <!-- col 4-->
                                    <div class="row">
                                        <div class="col" style="text-align: center;">
                                            <a href='cambia_password.php' style="text-decoration:none;">
                                                <div class="btnRegister font-weight-light" style="margin:50px auto;border-radius:6px;padding:5px">Cambia la tua password</div>
                                            </a>
                                    </div>
                    </div>
            </div>
    </div>
        <?php 
        include 'profilo_docente.php';
    } ?>   
        
        
        
        
        
    </body>
</html>