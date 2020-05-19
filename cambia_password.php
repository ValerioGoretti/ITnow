
<!doctype html>
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
        
        <script type="text/javascript"  language="javascript">
            

            function validaRegistrazione()
            {
                
                
                return valida();
            
                
            }
            function valida()
            {

                
                
                if (!($('#p1').val()==$('#p2').val())) {alert('Le due nuove password non corrispondono');return false;}
               
               return true;

 
            
                
            }
           
  
            
            
 


        
        </script>
        
    </head>
    <body>
        
        <?php include 'header.php';?>
        <div class="row"  style="height:100%;background-color:#822433; ">
            <div class="dati2"style="background-color: #ffffff;margin:50px auto">
            <form method="POST" action="rispondi_cambia_password.php"  onsubmit='return validaRegistrazione();'>
            <h2 class="font-weight-normal" style="color:black;">Cambia password</h3>
            <p class="font-weight-light"style="color:black;padding:10px">Per favore compila i seguenti campi</p>
            <div class="col-md-6" style="margin:0 auto">
                    
                    <div class="form-group" >
                        <input required name="up" minlength="6" type="password" class="form-control-registrazione" placeholder="Ultima password" value=""/>
                    </div>
                    <div class="form-group">
                        <input required  id="p1" name="np" minlength="6" type="password" class="form-control-registrazione" placeholder="Nuova password" value="" />
                    </div>
                    <div class="form-group">
                        <input required id="p2" name="email" minlength="6" id="emailStudente" type="password" class="form-control-registrazione" placeholder="Conferma password" />
                        
                    </div>
                    <div class="form-group" >
                        <input style="padding: 10px;border-radius: 5px; margin-left:30px;" type="submit" class="btnRegister font-weight-normal" value="Cambia Password" name="submit"/>
                    </div>                   
                </div>
            </form>
            </div>
        </div>
    </body>

</html>