    <?php
        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
        $email=$_SESSION['email'];
        $query="select ad.corso,ad.anno
                from docente join anno_docente on docente.email=anno_docente.docente join anno_didattico as ad on ad.id=anno_docente.anno join corso on ad.corso=corso.nome
                where docente.email= '$email'";
        $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
        ?>
                                        
                                 
            <div class="spazioPost" style="background-color:#822433;border-radius:6px ;padding:15px;">
                <form action="" class="post-form">
                <select class="selezionaCorso" id="cars" name="corso" >
                        <option disabled selected>inserisci il corso dove vuoi pubblicare il post</option>
                        <?php while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC)){?><option><?php echo $line['corso'] .' ' . $line['anno'];?></option><?php }?>
                </select>
                    <input type="text" class="textb" name="titolo" placeholder="Inserisci il titolo del post">
                    <textarea placeholder="Inserisci il testo del post" name="testo"></textarea>
                    <input type="file" id="files" class="file" name="files" multiple>
                    <div class="col">
                    <label for="files" class="segna"><div class="bttnn" for="files"><label for="files" class="segna">Allega file</div></label>
                        <div id="selectedFiles" class="select"> </div>
                    </div>
                    
                    <input type="submit" class="bttn" value='Pubblica'>
                </form>
                
                </div>
            </div>
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
	</script>
        
