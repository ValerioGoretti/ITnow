<?php

$dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
$email = $_SESSION['email'];

$query = "SELECT ad.corso,ad.anno
                from docente join anno_docente on docente.email=anno_docente.docente join anno_didattico as ad on ad.id=anno_docente.anno join corso on ad.corso=corso.nome                                                  
                where docente.email= '$email' and ad.id=$corso";
$result = pg_query($dbconn, $query) or die ('Query failed: ' . pg_last_error());
?>
<div class='row'>
    <p class="font-weight-light" style="margin-left:110px;font-size:40px;">Pubblica un post</p>
    <div class="line2"></div>
</div>
<div class="spazioPost" style="background-color:#822433;border-radius:6px ;padding:5px; margin-bottom:5%">
    <form action="pubblica_post.php" method="post" enctype="multipart/form-data" class="post-form">

        <div style="margin-left:70%; margin-bottom:1%">
            <div id="tastoClassico" class="btn btn-primary" style="margin-top:0%;">Testo <i
                        class="fas fa-align-justify"></i></div>
            <div id="tastoModerno" class="btn btn-primary" style="margin-top:0%;">Codice <i class="fa fa-code"
                                                                                            aria-hidden="true"></i>
            </div>
        </div>
        <div class="spazioPost" style="width:100%;height:100%;background-color:white;padding:5px;">

            <select class="selezionaCorso" id="corso" name="corso" required>

                <option selected><?php echo $nome . ' ' . $anno; ?></option>

            </select>
            <div id="spazio">
                <div id="classico">
                    <div class="line" style="width:550px;"></div>
                    <input type="text" class="textb" name="titolo" placeholder="Inserisci il titolo del post" required>
                    <div class="line" style="margin:10px auto; width:550px"></div>
                    <textarea class="textc" placeholder="Inserisci il testo del post" name="testo" required></textarea>
                </div>
                <!--CODICEEEEEEEEEEEEE-->
                <div id="moderno">
                    <div id="bottoni">
                        <div class="font-weight-light">Scegli uno dei seguenti linguaggi</div>
                        <div class="btn btn-primary" style="margin-top:0%" id="python" name="python"
                             onclick="setlang('python')">python
                        </div>
                        <div class="btn btn-primary" style="margin-top:0%" id="css" name="css" onclick="setlang('css')">
                            css
                        </div>
                        <div class="btn btn-primary" style="margin-top:0%" id="js" name="js"
                             onclick="setlang('javascript')">js
                        </div>
                        <div class="btn btn-primary" style="margin-top:0%" id="php" name="php" onclick="setlang('php')">
                            php
                        </div>
                        <div class="btn btn-primary" style="margin-top:0%" id="sql" name="sql" onclick="setlang('sql')">
                            sql
                        </div>
                        <div class="btn btn-primary" style="margin-top:0%" id="html" name="html"
                             onclick="setlang('xml')">html
                        </div>
                        <br>

                    </div>
                    <br>
                    <div id="scelta"
                         style="background-color:#282a36; color:#fff; width:100px; text-align:center;"></div>
                    <div id="codice"></div>
                </div>
            </div>
        </div>
        <input type="file" id="files" class="file" name="files[]" multiple>
        <div class="col">
            <label for="files" class="segna">
                <div class="btn btn-primary3" style="height:35px;" for="files"><label for="files" class="segna">Allega
                        file</div>
            </label>
            <div style="color:white;" id="selectedFiles" class="select"></div>
        </div>
        <input type="hidden" name="page" value="a">
        <input type="submit" class="btn btn-primary3" style="height:35px; margin-right:13px;" name="pubblica"
               value='Pubblica'>
    </form>


</div>

<script>
    var selDiv = "";

    document.addEventListener("DOMContentLoaded", init, false);

    function init() {
        document.querySelector('#files').addEventListener('change', handleFileSelect, false);
        selDiv = document.querySelector("#selectedFiles");
    }

    function handleFileSelect(e) {

        if (!e.target.files) return;

        selDiv.innerHTML = "";

        var files = e.target.files;
        for (var i = 0; i < files.length; i++) {
            var f = files[i];

            selDiv.innerHTML += "<i class=\"fas fa-file-alt\"></i>" + " " + f.name + "<br/>";

        }

    }

    <?php if (isset($_GET['messaggio'])) {
        $mess = $_GET['messaggio'];
        echo "alert('$mess');";
    } ?>
</script>

<script>
    var editor

    function setlang(lang) {
        document.getElementById('scelta').innerHTML = "<span>" + lang + "</span> <input type=\"hidden\" name=\"linguaggio\" value=\"" + lang + "\"> ";
        document.getElementById('codice').innerHTML = '<textarea name="code" id="editor"></textarea>';
        editor = CodeMirror.fromTextArea(document.getElementById('editor'), {
            mode: lang,
            theme: "dracula",
            lineNumbers: true,
            autoCloseTags: true,
            autoCloseBrackets: true
        });
        editor.setSize("100%", "400px");
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $("document").ready(function () {
        $('#moderno').hide();
        $('#tastoClassico').css({"background-color": "#fff", "color": "#822433"});

        $('#tastoClassico').click(function () {
            $('#tastoClassico').css({"background-color": "#fff", "color": "#822433"});
            $('#tastoModerno').css({"background-color": "#822433", "color": "#fff"});
            $('#moderno').hide();
            $('#classico').show();
        });

        $('#tastoModerno').click(function () {
            $('#tastoModerno').css({"background-color": "#fff", "color": "#822433"});
            $('#tastoClassico').css({"background-color": "#822433", "color": "#fff"});
            $('#classico').hide();
            $('#moderno').show();
        });
    });
</script>
        
