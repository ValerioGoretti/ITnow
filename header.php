<?php

$val=$_SESSION['img'];

?>
<div class="header row">
            <div class="col-2"  style="text-align:center" ><a href="index.html" ><img style="width:130px;height:130px;" src="/LOGHI/logo_con_testo_accanto_bordeaux.png"></img></a></div>
            <div class="ricerca col">  
                <form action="profiloCorso.php" method="get" name="corsoform">
               
                <input  type="text" placeholder="cerca un corso" autocomplete="off" list="corso" name="corso" class="testo" id="r" onchange="document.corsoform.submit();"/>
                
                <datalist id="corso" style="width:100%">
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
                </datalist>
                </form>
            </div>
            <a href="Home.php" style="text-decoration: none; color: #fff;"><div class="profile" ><i class="fas fa-home"></i></div></a>
            <a href="Profilo.php" style="text-decoration: none; color: #fff;"><div class="profile" ><?php if(!file_exists("img_docente/".$val.".png")) echo '<i class="fas fa-user" ></i>' ?>
                                <?php if(file_exists("img_docente/".$val.".png"))   echo "<img src='img_docente/$val.png' style='width: 80%;'>"?></div></a>
            <a href="logout.php" style="text-decoration: none; color: #fff;"><div class="profile" ><i class="fas fa-sign-out-alt" ></i></div></a>
        </div>