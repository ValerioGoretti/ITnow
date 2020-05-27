<div class="spazioPost" style="background-color:#822433;border-radius:6px ;padding:5px; margin-bottom:5%">
    <?php
        
        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
        $email=$_SESSION['email'];
        $query="select ad.corso,ad.anno
                from docente join anno_docente on docente.email=anno_docente.docente join anno_didattico as ad on ad.id=anno_docente.anno join corso on ad.corso=corso.nome
                where docente.email= '$email' and stato='In corso'";
        $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
        if(pg_num_rows ( $result )==0){
                echo "<div class=containerTitolo>";
                echo "<h3>Non hai corsi attivi dove inserire post</h3>";
                echo "<div style=\"margin-top:5%\"><h6>Puoi creare un corso o attivarne uno dei tuoi già terminati</h6></div>";
                echo "</div>";
        }
        else{
        ?>
                                        
                                 
               
                <form action="pubblica_post.php" method="post" enctype="multipart/form-data" class="post-form">
                    <div class="spazioPost" style="width:100%;height:100%;background-color:white;padding:5px;">
                    
                    <select class="selezionaCorso" id="corso" name="corso" required>
                            <option disabled default>inserisci il corso dove vuoi pubblicare il post</option>
                            <?php while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC)){?>
                                <option ><?php echo $line['corso'] . ' ' . $line['anno'];?></option>
                            <?php }?>
                    </select>
                        <div class="line"style="width:550px"></div>
                        <input type="text" class="textb" name="titolo" placeholder="Inserisci il titolo del post" required>
                        <div class="line"style="margin:10px auto; width:550px"></div>
                        <textarea class="textc" placeholder="Inserisci il testo del post" name="testo" required></textarea>
                        </div>
                        <input type="file" id="files" class="file" name="files[]" multiple>
                        <div class="col">
                        <label for="files" class="segna"><div class="bttnn" for="files"><label for="files" class="segna">Allega file</div></label>
                            <div id="selectedFiles" class="select"> </div>
                        </div>
                        
                    <input type="submit" class="bttn" name="pubblica" value='Pubblica'>
                </form>
                
    <?php }
    ?>            
                
            </div>
     

    <script>
	var selDiv = "";
		
	document.addEventListener("DOMContentLoaded", init, false);
	
	function init() {
		document.querySelector('#files').addEventListener('change', handleFileSelect, false);
		selDiv = document.querySelector("#selectedFiles");
	}
		
	function handleFileSelect(e) {
		
		if(!e.target.files) return;
		
		selDiv.innerHTML = "";
		
		var files = e.target.files;
		for(var i=0; i<files.length; i++) {
			var f = files[i];
			
			selDiv.innerHTML += "<i class=\"fas fa-file-alt\"></i>"+ " " + f.name + "<br/>";

		}
		
	}

    <?php if(isset($_GET['messaggio'])){
            $mess=$_GET['messaggio'];
               echo "alert('$mess');";
         } ?>
	</script>
        
