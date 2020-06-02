<!DOCTYPE html>
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/password_dimenticata.css">
    <link href="css/registrazione.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <script>
        function validaMail() {
            var tipo = '<?php echo $_GET['tipo'];?>';
            var mail = $("#email").val();
            console.log(mail);
            var request = new XMLHttpRequest();
            request.open("GET", "json/dati_studenti.json", false);
            request.send(null);
            var risultato = JSON.parse(request.responseText);
            var request2 = new XMLHttpRequest();
            request2.open("GET", "json/dati_docenti.json", false);
            request2.send(null);
            var risultato2 = JSON.parse(request2.responseText);

            if (tipo == 's') {
                for (i = 0; i < risultato.length; i++) {
                    if (risultato[i]["mail"] == mail) {
                        $('#valerio').val("false");
                        return true;
                    }

                }
            }
            if (tipo == 'd') {
                for (i = 0; i < risultato2.length; i++) {
                    if (risultato2[i]["mail"] == mail) {
                        $('#valerio').val("true");
                        return true;
                    }
                }
            }

            alert('La mail inserita non è valida.')
            return false;

        }
    </script>

</head>
<body>
<div style="background-color: #822433; width: 100%; height: 700px;">
    <div class="row">
        <div class="col-md-6" style="margin: 0 auto;">
            <div class="container-password">
                <p1 class="font-weight-bold">Inserisci la mail relativa all'account di cui vuoi recuperare la password
                </p1>
                <br>
                <form method="post" action="rispondi_password_dimenticata.php" onsubmit="return validaMail();">
                    <div class="row register-form ">

                        <div class="col-md-6" style="margin: 0 auto;">
                            <div class="form-group" style="margin-top: 50px;">
                                <input id="email" type="text" class="form-control-registrazione" placeholder="Email"
                                       value="" name="email"/>
                            </div>
                            <input type="hidden" id="valerio" name="valerio">
                            <input type="submit" class="btnRegister"
                                   style="margin-left: 40px; padding: 7px;border-radius: 10px;"
                                   value="Recupera password" name="submit"/>


                        </div>
                    </div>
                </form>

            </div>


        </div>

    </div>
</div>


</body>
</html>