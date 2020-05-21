

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

                    
            });});
    </script>
         


    </head>
    <div class="rightBar font-weight-light" style="width:250px;padding:5px;color:white;">
        <h5>Crea anno didattico</h5>
        <form action="">
        <div style="background-color:white;whidth:100px;height:150px;border-radius:6px;padding:5px;">
        
                <select class="selezionaCorso" id="cars" name="corso" style="width:150px;margin:0 auto;height:30px;" required>
                        <option disabled selected>Corso</option>
                        <?php while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC)){?>
                            <option><?php echo $line['corso'] .' ' . $line['anno'];?></option>
                        <?php }?>
                        
                </select>
                
                <div class="line" style="margin-top:20px"></div>
                <p style="margin:10px auto;color:black;">Data di inizio</p>
                <input type="date" style="margin:0px auto;" placeholder="inserisci la data in formato gg/mm/aaaa">
    
  
              

        
        </div>
        <div id="spazioCollaboratori">
            <p style=";">Aggiungi collaboratore<p>
        </div>
        
        <div class="row">
            <input type="email" id="collaboratore" style="margin-left:15px; width:190px;"placeholder="Email docente">
            <a id="add" ><i style="font-size:25px;margin-left:20px;" class="fas fa-user-plus" ></i></a>
        </div>
        </form>
    </div>
