<?php

/**
 * Header utilizzato in quasi tutte le pagine del progetto. contiene i vari pulsanti per tornare al profilo, home ed effettuare il logout
 */
$val=$_SESSION['img'];

?>
<div class="header row">
            <div class="col-2"  style="text-align:center" ><a href="index.html" ><img style="width:130px;height:130px;" src="/LOGHI/logo_con_testo_accanto_bordeaux.png"></img></a></div>
            <div class="ricerca col">  
                <form action="profiloCorso.php" method="get" name="corsoform">
               
                
                
                <select id="corsoheader" name="corso" style="width:100%; outline:none;"  onchange="document.corsoform.submit();">
                    <option class="prova" value="" selected disabled>Seleziona un corso</option>
                    <?php   
                             $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
                             $query="SELECT * FROM  corso;";
                             $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
                             while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC))
                             {
                            ?>
                                    <option class="prova" value="<?php echo $line['nome'] ?>"><?php echo $line['nome'] ?></option>
                                    <?php 
                            }?>
                </select>
                </form>
            </div>
            <a href="Home.php" style="text-decoration: none; color: #fff;"><div class="profile" ><i class="fas fa-home"></i></div></a>
            <a href="Profilo.php" style="text-decoration: none; color: #fff;"><div class="profile" ><?php if(!file_exists("img_docente/".$val.".png")) echo '<i class="fas fa-user" ></i>' ?>
                                <?php if(file_exists("img_docente/".$val.".png"))   echo "<img src='img_docente/$val.png' style='width: 80%;'>"?></div></a>
                            
            <a href="logout.php" style="text-decoration: none; color: #fff;"><div class="profile" ><i class="fas fa-sign-out-alt" ></i></div></a>
        </div>



<script>
		$(document).ready(function(){
			$(".default_option").click(function(){
			  $(this).parent().toggleClass("active");
			})

			$(".select_ul li").click(function(){
			  var currentele = $(this).html();
			  $(".default_option li").html(currentele);
			  $(this).parents(".select_wrap").removeClass("active");
			})
		});
	</script>