<!doctype html>
<html lang="en">
<head>
    <title>PHP - jquery ajax crop image before upload using croppie plugins</title>
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>


</head>
<body>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Carica immagine</div>
        <div class="panel-body" style="background-color:#822433">


            <div class="row font-weight-light">
                <div class="col-md-4 text-center">
                    <div id="upload-demo" style="width:350px"></div>
                </div>
                <div class="col-md-4" style="padding-top:30px;">


                    <input type="file" id="upload" style="color:white;">
                    <br/>
                    <button class="btn btn-success upload-result" id="vai"
                            style="background-color:#ffff;color:black;border:none;">Upload Image
                    </button>
                    <div id="ok" style="margin-top:200px;margin-left:50px; color:white">
                        <h5>Immagine caricata con successo!</h5>
                        <div class="btn btn-xl btn-primary inserimento" id="chiudi"
                             style="width:200px;border:none;background-color:#fff;color:#822433">Chiudi e torna
                            indietro!
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="color:white">
                    <div id="upload-demo-i"
                         style="background:#e1e1e1;width:300px;padding:30px;height:300px;margin-top:30px"></div>
                </div>

            </div>


        </div>
    </div>
</div>


<script type="text/javascript">
    $('#ok').hide();
    $("#vai").hide();
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });


    $('#upload').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function () {
                console.log('jQuery bind complete');
                $("#vai").show();
            });

        }
        reader.readAsDataURL(this.files[0]);
    });

    $('#chiudi').on('click', function (ev) {
        window.opener.location.reload();
        window.close();

    });


    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {


            $.ajax({
                url: "/ajax-img.php",
                type: "POST",
                data: {"image": resp},
                success: function (data) {
                    html = '<img src="' + resp + '" />';
                    $("#upload-demo-i").html(html);
                    console.log(resp);
                    if (resp != "") $('#ok').show();


                }
            });
        });
    });
    window.addEventListener("close", function (event) {
        // make the close button ineffective
        window.opener.location.reload();
    }, false);


</script>


</body>
</html>