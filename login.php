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
            session_start();
            
            //echo("accesso docente riuscito");
            
            $_SESSION['email']=$_GET["email"];
            $_SESSION['logged']=true;
            header("Location: Home.php");
            //echo("<br><a href='logout.php'>Effettua il logout</a>");

    
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
        session_start();
        $_SESSION["matricola"]=$_GET["matricola"];
        $_SESSION["logged"]=true;
        header("Location: Home.php");
 

    }

}






function validaDocente($matricola,$password)
{

    if((!empty($matricola))&&(!empty($password)))
    {
    $data=file_get_contents("json/dati_docenti.json");
    $data=json_decode($data,true);
    
    $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
    $password2=md5($password);
    $query= "SELECT *
            FROM docente 
            WHERE email='$matricola' and password='$password2'";
    $result = pg_query_params($dbconn,$query,array()) or die ('Query failed: '.pg_last_error());
    if(pg_num_rows($result)!=0)return true;
    return false;
    }
    return false;
}

function validaStudente($matricola,$password)
{

    if((!empty($matricola))&&(!empty($password)))
    {
        if((!empty($matricola))&&(!empty($password)))
        {
        $data=file_get_contents("json/dati_docenti.json");
        $data=json_decode($data,true);
        
        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
        $password2=md5($password);
        $query= "SELECT *
                FROM studente 
                WHERE matricola='$matricola' and password='$password2'";
        $result = pg_query_params($dbconn,$query,array()) or die ('Query failed: '.pg_last_error());
        if(pg_num_rows($result)!=0)return true;
        return false;
        }
        return false;
    }
}
?>