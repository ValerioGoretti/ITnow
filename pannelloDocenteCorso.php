<?php
        
        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
        $email=$_SESSION['email'];
        
        $query="select ad.corso,ad.anno
                from docente join anno_docente on docente.email=anno_docente.docente join anno_didattico as ad on ad.id=anno_docente.anno join corso on ad.corso=corso.nome
                where docente.email= '$email' and ad.id=$corso";
        $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
        ?>
                                        
                                 
            <div class="spazioPost" style="background-color:#822433;border-radius:6px ;padding:5px; margin-bottom:5%">
                <form action="pubblica_post.php" method="post" enctype="multipart/form-data" class="post-form">
                    <div class="spazioPost" style="width:100%;height:100%;background-color:white;padding:5px;">
                    
                    <select class="selezionaCorso" id="corso" name="corso" required>
                            <?php while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC)){?>
                                <option selected><?php echo $line['corso'] . ' ' . $line['anno'];?></option>
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
                
                
                
            </div>
     
            <?php pg_close($dbconn);?>
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
        
