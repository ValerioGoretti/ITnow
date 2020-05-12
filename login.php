<?php
    include "updateDocentiJson.php";
    include "updateStudentiJson.php";
    run();
    run2();
    if (isset($_SESSION)) session_destroy();
    if(isset($_GET['loginD']))
    {
        if(!validaDocente($_GET["email"],$_GET['passwordDocente']))
        { 
            readfile("index.html");
            echo '<script language="javascript">';
            echo 'alert("Matricola o password errate, riprovare per favore.")';
            echo '</script>';
            
    
        }
        else{
    
        }
    
    }
if(isset($_GET['loginS']))
{
    if(!validaStudente($_GET["matricola"],$_GET['passwordStudente']))
    { 
        readfile("index.html");
        echo '<script language="javascript">';
        echo 'alert("Matricola o password errate, riprovare per favore.")';
        echo '</script>';
        

    }
    else{

    }

}
function validaDocente($matricola,$password)
{

    if((!empty($matricola))&&(!empty($password)))
    {
    $data=file_get_contents("json/dati_docenti.json");
    $data=json_decode($data,true);
    
    foreach($data as $riga)
    {

        
        if(($riga['mail']==$matricola)&&($riga['password']==md5($password)))
        {
            
            
            session_start();
            
            echo("accesso docente riuscito");
            
            
            echo("<br><a href='logout.php'>Effettua il logout</a>");

            return true;
        }
       
    }
    return false;
    }
}

function validaStudente($matricola,$password)
{

    if((!empty($matricola))&&(!empty($password)))
    {
    $data=file_get_contents("json/dati_studenti.json");
    $data=json_decode($data,true);
    
    foreach($data as $riga)
    {
        
        
        if(($riga['matricola']==$matricola)&&($riga['password']==md5($password)))
        {
            
            session_start();
            $_SESSION["CANE"]="BAUBAU";
            echo("accesso riuscito");
            
            
            echo("<br><a href='logout.php'>Effettua il logout</a>");

            return true;
        }
       
    }
    return false;
    }
}
?>