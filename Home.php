<?php
    session_start();
    $logged=isset($_SESSION['logged']);
    
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
            
            var logged=('<?php echo $logged ?>'=='1');

            if (!logged)
            {
                alert("sessione scaduta,eseguire il login");
                $(window.location).attr('href',"index.html#login");

            }

            $("document").ready(function(){
                $('#files').hide();        
            });

        </script>
    </head>
    <body>
        <?php include 'header.php'?>
        <?php include 'leftBar.php'?>
        
        <?php include 'rightBar.php'?>
        <div class="core">
            <?php 
                if($_SESSION['ruolo']=='docente'){
                    include 'pannelloDocente.php'; 
                }
                if($_SESSION['ruolo']=='studente'){     
                    include 'pannelloStudente.php';
                }
                
            ?>
        </div>
        
    </body>
</html>