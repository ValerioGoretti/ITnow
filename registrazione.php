<?php
    include "updateDocentiJson.php";
    include "updateStudentiJson.php";
    run();
    run2();
                    
?>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/registrazione.css">
        <link href="css/styles.css" rel="stylesheet" />
        
        <script type="text/javascript"  language="javascript">
            
            function validaRegistrazione2()
            {
                    return valida2();
            }
            function validaRegistrazione()
            {
                
                return valida();
            
                
            }
            function valida()
            {
                var request = new XMLHttpRequest();
                request.open("GET", "dati_studenti.json", false);
                request.send(null)
                var risultato = JSON.parse(request.responseText);
                var mail=document.getElementById("emailStudente").value;
                var matricola=document.getElementById("matricola").value;   
                var p1=document.getElementById("p1").value;
                var p2=document.getElementById("p2").value;
                
                var isnum = /^\d+$/.test(matricola); 
          
                for (i=0;i<risultato.length;i++)
                {
                    
                   
                   
                   if(risultato[i]["mail"]==mail) {alert("La mail inserita non è valida o già utilizzata");return false;}  
                    if((risultato[i]["matricola"]==matricola)||(!isnum)){alert("Matricola non valida o già esistente");return false;}
                    if(p1!=p2){alert("Le due password inserite sono differenti");return false;}


                    
                }
                return true;

 
            
                
            }
            function valida2()
            {
                var request = new XMLHttpRequest();
                request.open("GET", "dati_docenti.json", false);
                request.send(null)
                var risultato = JSON.parse(request.responseText);
                var mail=document.getElementById("emailStudente2").value;
                  
                var p1=document.getElementById("p12").value;
                var p2=document.getElementById("p22").value;
                
                
          
                for (i=0;i<risultato.length;i++)
                {
                    
                   
                   
                   if(risultato[i]["mail"]==mail) {alert("La mail inserita non è valida o già utilizzata");return false;}  
                   
                    if(p1!=p2){alert("Le due password inserite sono differenti");return false;}


                    
                }
                return true;

 
            
                
            }
  
            
            
 


        </script>
    </head>
    <body >
        
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light  py-3" id="mainNav" style="background-color: #822433;">
        <div class="container" >
            <a class="navbar-brand js-scroll-trigger" href="index.html#page-top">ITnow</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive"></div>
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.html#login">Torna al Login</a></li>
   
                </ul>
        </div>   
    </nav>
    <!--Contenitore registrazione-->
        <div class="container2" style="background-color: #822433; height: 1200px;;" ><br><br>
            <div class="container_registrazione">
                <h1 id="regStudenti" class="t  font-weight-bold" style="color: #822433;">Registrazione Studenti</h1>
                <br>
                <br>
                
            <form class="row register-form" name="formStudenti" method="GET" action="risposta_registrazione.php"  onsubmit="return validaRegistrazione();">
                
                <div class="col-md-6">
                    <div class="form-group" >
                        <input required name="nome" type="text" class="form-control-registrazione" placeholder="Nome" value="" required/>
                    </div>
                    <div class="form-group">
                        <input required name="cognome" type="text" class="form-control-registrazione" placeholder="Cognome" value="" required/>
                    </div>
                    <div class="form-group">
                        <input required name="email" id="emailStudente" type="email" class="form-control-registrazione" placeholder="Email " required />
                        
                    </div>                    
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <input  name="matricola"id="matricola" maxlength="7"  type="text"  class="form-control-registrazione" placeholder="Matricola"  required/>
                    </div>
                    <div class="form-group">
                        <input  name="password" minlength="6" type="password" id="p1" class="form-control-registrazione" placeholder="Password " value="" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" minlength="6" id="p2" class="form-control-registrazione" placeholder="Conferma Password " value="" required/>
                    </div>

  
                    <div class="form-group" >
                    <input style="padding: 10px;border-radius: 5px;" type="submit" class="btnRegister" value="Registrazione" name="res"/>
                    </div>
                </div>
            </form>
            </div>
            
           

            <br>
            
            <div class="container_registrazione"id="regDocenti" name="regDocenti">
                <h1 class="t font-weight-bold"  style="color: #822433;">Registrazione Docenti</h1>
                <p class="t font-weight-bold">La registrazione dei docenti sarà sottoposta ad azioni di convalidazione da parte della moderazione del portale.</p>
                <br>
                <br>
                <form class="row register-form " action="rispondi_registrazione_docenti.php" onsubmit="return validaRegistrazione2();" method="GET">
                    <div class="col-md-6">
                        <div class="form-group" >
                            <input required name="nome2" id="nome2" type="text" class="form-control-registrazione" placeholder="Nome" value=""/>
                        </div>
                        <div class="form-group">
                            <input required name="cognome2" id="cognome2" type="text" class="form-control-registrazione" placeholder="Cognome" value="" />
                        </div>
                        <div class="form-group">
                            <input required name="email2" id="emailStudente2" type="email" class="form-control-registrazione" placeholder="Email" value="" />
                        </div>
 
    
    
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input required name="p12" id="p12" minlength="6" type="password" class="form-control-registrazione" placeholder="Password " value="" />
                        </div>
                        <div class="form-group">
                            <input required minlength="6" name="p22" id="p22" type="password" class="form-control-registrazione" placeholder="Conferma Password " value="" />
                        </div>
                        

                        <div class="form-group">
                        <input  type="submit" style="padding: 10px;border-radius: 5px;" class="btnRegister" value="Registrazione" name="doc"/>
                        </div>
                    </div>
                </form>
               
            </div>

        </div>
        
        
    </div>
    </body>
</html>
