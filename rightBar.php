
<?php
    include 'updateDocentiJson.php';
    runDoc();
?>
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        
    <script>
         
         var listaCrea=[];
         function ValidateEmail(mail) 
        {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
        {
            return (true)
        }
        alert("Email inserita non valida!")
        return (false)
        }
         $("document").ready(function(){
            $('#add').click(function(){
                    if(($('#collaboratore').val()!="") &&
                    (ValidateEmail($('#collaboratore').val()))&&(!(listaCrea.includes($('#collaboratore').val()))))
                    {
                      
                        $('#spazioCollaboratori').append($('#collaboratore').val()+"<br>");
                        listaCrea.push($('#collaboratore').val());
                        console.log(listaCrea);
                    }

                    
            });
            $('#crea').click(function(){
                if(verificaEmail(listaCrea)&& (!listaCrea.includes('<?php echo $_SESSION['email']?>'))){
                $.ajax({
                            type: "GET",
                            url: "crea-anno.php",
                            data: {corso:$('#cars').val(),data:$('#data').val(),docente:'<?php echo $_SESSION['email'];?>',col: listaCrea},
                            success: function(msg){
                            window.location.reload();
                            alert(msg);                              
                            }
                 });}
                 else{alert("Email collaboratori inserite non valide");}  

                    
            });
            
            });
            function verificaEmail(array)
        {
           
            var request2 = new XMLHttpRequest();
                request2.open("GET", "json/dati_docenti.json", false);
                request2.send(null);
                var risultato2 = JSON.parse(request2.responseText);
                for (i=0;i<array.length;i++)
                {   
                    var presente=false;
                    for(n=0;n<risultato2.length;n++)
                    {
                        if((risultato2[n]['mail'])==array[i]) {presente=true;}
                  }
                    if (!presente) return false;
                }
                return true;
        }    
    </script>
         


    </head>
    <div class="rightBar font-weight-light" style="width:250px;padding:5px;color:white;">
        <h5>Crea anno didattico</h5>
        <form action="">
        <div style="margin:0 auto;background-color:white;whidth:70%;height:fit-content;border-radius:6px;padding:5px;">
        
                <select class="selezionaCorso" id="cars" name="corso" style="width:100%;height:30px;" required>
                        <option disabled selected>Corso</option>
                        <?php   
                        
                        $string=file_get_contents('json/corsi.json', 'r');
                        $corsi=json_decode($string,true);
                        $no_dup =[];
                        foreach($corsi as $c){
                            if(!in_array($c['nomeCorso'],$no_dup))
                            {?>
                                <option class="prova" value="<?php echo $c['nomeCorso'] ?>"><?php echo $c['nomeCorso'] ?></option>
                                <?php array_push($no_dup,$c['nomeCorso']);
                        }}?>
                        
                </select>
                
                <div class="line" style="margin-top:20px"></div>
                <p style="margin:10px auto;color:black;">Data di inizio</p>
                <input type="date" name="data" min='<?php echo date("Y-m-d")?>' id="data" style="width:100%;" placeholder="inserisci la data in formato gg-mm-aaaa">
    
  
              

        
        </div>
        <div id="spazioCollaboratori">
            <p style=";">Aggiungi collaboratore<p>
        </div>
        
        <div class="row">
            <input type="email" id="collaboratore" style="margin-left:15px; width:190px;"placeholder="Email docente">
            <a id="add" ><i style="font-size:25px;margin-left:20px;" class="fas fa-user-plus" ></i></a>
        </div>
        <button href="#" id="crea"style="margin:20px 35px;" class="btn btn-primary2" name="corso">Crea anno didattico</a>
        </form>
    </div>
