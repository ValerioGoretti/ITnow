<!DOCTYPE html>
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/registrazione.css">
    <link href="css/profilo.css" rel="stylesheet"/>
    <link href="css/profilo.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="css/home.css" rel="stylesheet">
    <title></title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
          rel="stylesheet" type="text/css"/>
    <!-- Third party plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
          rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

    <script>

        $("document").ready(function () {
            $('#leftbar').css({"background-color": "#fff", "color": "#822433"});
            $('#titolo').css({"color": "#822433"});
            $('#corsi').css({"color": "#822433"});
            $('.leftcard').css({"background-color": "#822433", "color": "#fff"});
            $('.leftcard').css({"background-color": "#822433", "color": "#fff"});
            $('#colla').css({"color": "#822433"});
        });

    </script>

</head>
<body>

<?php session_start();
include 'header.php';


$corso = $_GET['corso'];
$corso = ucfirst($corso);


?>

<div class='row' id="app" style="background-color:#822433; width:100%; height:700px; padding:3%">
    <!--immagine profilo-->


    <div class="barrasinistra " style="background-color:white; width:fit-content; float:left;">
        <?php include 'leftBar.php' ?>
    </div>

    <!--riepilogo dati-->
    <?php
    $nomeCorso = '';
    $query = "select *
                from corso
                where nome='$corso';";
    $result = pg_query($dbconn, $query) or die ('Query failed: ' . pg_last_error());
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        $nomeCorso = $line['nome'];
    }
    ?>

    <form class="col containerCorso" action="homeAnno.php" method="get" name="homeAnno" id="container">
        <div style="margin-left:20px;font-size:50px;">
            <p class="font-weight-light"><?php echo $nomeCorso; ?></p></div>
        <div class='row rigaCorso' id="riga">


            <?php
            $query2 = "select anno_didattico.id as anno_id, corso.nome as nome_corso,corso.descrizione as descrizione_corso, anno_didattico.anno as anno_corso,docente.nome as nome_docente,docente.cognome as cognome_docente,docente.email as email_docente,anno_didattico.stato
                      from corso join anno_didattico on corso.nome=anno_didattico.corso join anno_docente on anno_didattico.id=anno_docente.anno join docente on anno_docente.docente=docente.email
                      where corso.nome='$corso';";
            $result2 = pg_query($dbconn, $query2) or die ('Query failed: ' . pg_last_error());
            while ($line2 = pg_fetch_array($result2, null, PGSQL_ASSOC)) {
                ?>
                <div class="card cartaCorso grow" style="color:white;background-color:#822433;margin-bottom:20px;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $line2['nome_docente'] . ' ' . $line2['cognome_docente'] ?></h5>
                        <p class="card-text font-weight-light">Anno:<?php echo $line2['anno_corso'] ?>
                            <br>Stato:<?php echo $line2['stato'] ?></p>
                        <button href="#" class="btn btn-primary2" value="<?php echo $line2['anno_id'] ?>" name="corso">
                            Vai all'anno didattico</button>
                    </div>
                </div>
            <?php } ?>
        </div>


    </form>

</div>


<script>

    function getCount(parent, getChildrensChildren) {
        var relevantChildren = 0;
        var children = parent.childNodes.length;
        for (var i = 0; i < children; i++) {
            if (parent.childNodes[i].nodeType != 3) {

                relevantChildren++;
            }
        }
        return relevantChildren;
    }

    var element = document.getElementById("riga");
    if (getCount(element, false) <= 2)
        $('.rigaCorso').css('height', '250px');
</script>
</body>
</html>