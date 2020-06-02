<?php
session_start();
?>
<!doctype html>
<html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/registrazione.css">
    <link href="css/profilo.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="css/home.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

</head>
<body>

<?php include 'header.php'; ?>
<div class="row" style="height:100%;background-color:#822433; ">
    <div class="dati" style="background-color: #ffffff;margin:50px auto;height:fit-content;">


        <div style="margin:50px auto;width:fit-content;height:fit-content;">
            <p class="font-weight-normal" style="color:black;font-size:20px">Password cambiata con successo</p>
        </div>
        <div style="margin:50px auto;width:fit-content;height:fit-content;">
            <a href='Home.php'>
                <div class="btnRegister font-weight-light" style="margin:0 auto;border-radius:6px;padding:5px">Torna
                    alla home
                </div>
            </a>
        </div>


    </div>
</div>
</body>

</html>
