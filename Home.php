<?php
    /**
     * Home principale che gestisce gli ultimi post (con limite di 10 ) per gli studenti
     * e nel caso del docente verrà mostrata la pubblicazione veloce dei post sui corsi che il docente tiene.
     */
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
        
        <!-- Code Mirror       -->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <script src="/codemirror/lib/codemirror.js"></script>
        <link href="/codemirror/lib/codemirror.css" rel="stylesheet">
        <script src="/codemirror/mode/xml/xml.js"></script>
        <script src="/codemirror/mode/python/python.js"></script>
        <script src="/codemirror/mode/css/css.js"></script>
        <script src="/codemirror/mode/javascript/javascript.js"></script>
        <script src="/codemirror/mode/php/php.js"></script>
        <script src="/codemirror/mode/sql/sql.js"></script>
        <script src="/codemirror/mode/vue/vue.js"></script>
        <script src="/codemirror/addon/edit/closebrackets.js"></script>
        <script src="/codemirror/addon/edit/closetag.js"></script>
        <link href="/codemirror/theme/dracula.css"  rel="stylesheet">







        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script>
            
            var logged=('<?php echo $logged ?>'=='1');

            if (!logged)
            {
                alert("sessione scaduta,eseguire il login");
                $(window.location).attr('href',"index.html#login");

            }
            $('document').ready(function(){
                $('#files').hide();
            });

           

        </script>
    </head>
    <body>
        <?php include 'header.php'?>
        <?php include 'leftBar.php'?>
        
        <?php include 'rightBar-control.php'?>
        <div class="core" style="width:1000px">
            <?php 
                if($_SESSION['ruolo']=='docente'){
                    include 'pannelloDocente.php'; 
                }
                if($_SESSION['ruolo']=='studente'){     
                    include 'pannelloStudente.php';
                }
                
        pg_close($dbconn);
            
            ?>
        </div>
        
    </body>
</html>