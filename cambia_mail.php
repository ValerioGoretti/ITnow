<?php
include 'updateStudentiJson.php';
run2();
session_start();
$matricola = $_SESSION['matricola'];
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

    <script type="text/javascript" language="javascript">

        $("document").ready(function () {


            $('#cambia').click(function (event) {

                event.preventDefault();
                if ($('#cambia').val() == 'Cambia Email') {
                    if (valida()) {
                        $.ajax({
                            type: "GET",
                            url: "rispondi_cambia_mail.php",
                            data: {email: $('#p1').val(), studente: '<?php echo $matricola;?>'},
                            success: function (msg) {

                                console.log(msg);
                                $('#titolo').text('Email cambiata con successo');
                                $('#sottotitolo').hide();
                                $('#p1').hide();
                                $('#cambia').attr('value', 'Torna alla home');
                                $('#form').attr('method', 'GET');
                                $('#form').attr('action', 'Home.php');


                            }
                        });
                    }
                } else {
                    window.location.href = "Home.php";
                }
            });
        });


        function valida() {


            var mail = $('#p1').val();
            console.log(mail);
            var request = new XMLHttpRequest();
            request.open("GET", "json/dati_studenti.json", false);
            request.send(null)
            var risultato = JSON.parse(request.responseText);
            var request2 = new XMLHttpRequest();
            request2.open("GET", "json/dati_docenti.json", false);
            request2.send(null)
            var risultato2 = JSON.parse(request2.responseText);

            for (i = 0; i < risultato.length; i++) {


                if ((risultato[i]["mail"] == mail)) {
                    alert("La mail inserita non è valida o già utilizzata");
                    return false;
                }


            }
            for (i = 0; i < risultato2.length; i++) {


                if ((risultato2[i]["mail"] == mail)) {
                    alert("La mail inserita non è valida o già utilizzata");
                    return false;
                }


            }
            return true;


        }


    </script>

</head>
<body>

<?php include 'header.php'; ?>
<div class="row" style="height:100%;background-color:#822433; ">
    <div class="dati2" style="background-color: #ffffff;margin:50px auto">

        <h3 id="titolo" class="font-weight-normal" style="margin-top:10px;margin-left:20px;color:black;">Cambia
            email</h3>
            <p id="sottotitolo" class="font-weight-light" style="margin-left:15px;color:black;padding:10px">Per favore
                compila i seguenti campi</p>
            <div class="col-md-6" style="margin:0 auto">
                <form id='form'>


                    <div class="form-group" style="margin-top:50px">
                        <input required id="p1" name="np" minlength="6" type="email" class="form-control-registrazione"
                               placeholder="Nuova email" value=""/>
                    </div>

                    <div class="form-group">
                        <input id='cambia' style="padding: 10px;border-radius: 5px; margin-left:30px;margin-top:90px;"
                               type="submit" class="btnRegister font-weight-light" value="Cambia Email" name="submit"/>
                    </div>
            </div>
            </form>
    </div>
</div>
</body>

</html>