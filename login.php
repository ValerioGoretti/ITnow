<?php
    include "updateDocentiJson.php";
    include "updateStudentiJson.php";
    runDoc();
    run2();
    session_start();
    if (session_status() != PHP_SESSION_NONE) {session_destroy();}
    
    if(isset($_GET['loginD']))
    {
        if(!validaDocente($_GET["email"],$_GET['passwordDocente']))
        { 
            readfile("index.html");
            echo '<script language="javascript">';
            echo 'alert("Email o password errate, riprovare per favore.")';
            echo '</script>';
            
    
        }
        else{
            session_start();
            
            //echo("accesso docente riuscito");
            
            $m=$_GET['email'];
            $_SESSION['logged']=true;
            $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
            $que="select nome,cognome,email 
                  from docente
                  where email='$m'
                  ";
            $res = pg_query($dbconn,$que) or die ('Query failed: '.pg_last_error());
            while ($line  = pg_fetch_array($res,null,PGSQL_ASSOC)){
                
                    $_SESSION["nome"]=$line["nome"]." ".$line["cognome"];
                    $_SESSION["email"]=$line["email"];

                
                }
            $_SESSION['ruolo']='docente';
            $_SESSION['img']=$_SESSION["email"];
            pg_close($dbconn);
            header("Location: Home.php");
            //echo("<br><a href='logout.php'>Effettua il logout</a>");
            
    
        }
    
    }

else
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

        $mat=$_SESSION["matricola"];
        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
        $que="select matricola,nome,cognome,email 
              from studente
              where matricola='$mat'
              ";
        $res = pg_query($dbconn,$que) or die ('Query failed: '.pg_last_error());
        while ($line  = pg_fetch_array($res,null,PGSQL_ASSOC)){
            
                $_SESSION["nome"]=$line["nome"]." ".$line["cognome"];
                $_SESSION["email"]=$line["email"];
                
            }
            $_SESSION["ruolo"]='studente';
            $_SESSION['img']=$_SESSION["matricola"];
            
            header("Location: Home.php");
            pg_close($dbconn);
            
        
    

   

    }
    
    
}
pg_close($dbconn);










function validaDocente($matricola,$password)
{

    if((!empty($matricola))&&(!empty($password)))
    {

    
    
    $password2=md5($password);
    try{
        $mypdo=new PDO("pgsql:host=rogue.db.elephantsql.com;dbname=xsyvwldl","xsyvwldl","3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev",array(PDO::ATTR_PERSISTENT => true));
        
        $query= "SELECT *
        FROM docente 
        WHERE email=:matricola and password=:password";
        $stm=$mypdo->prepare($query);
        $stm->bindValue(':matricola',$matricola,PDO::PARAM_STR);
        $stm->bindValue(':password',$password2,PDO::PARAM_STR);

        $result=$stm->execute();
        if($result){$user=$stm->fetch();
            if($user){return true;}               
        }
        else{return false;}
        $mypdo=null;

        
    }
    catch(PDOException $e){echo $e->getMessage();}

    }
    
    return false;
}

function validaStudente($matricola,$password)
{


        if((!empty($matricola))&&(!empty($password)))
        {
 
        
        
        $password2=md5($password);
        try{
            $mypdo=new PDO("pgsql:host=rogue.db.elephantsql.com;dbname=xsyvwldl","xsyvwldl","3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev",array(PDO::ATTR_PERSISTENT => true));
            
            $query= "SELECT *
            FROM studente 
            WHERE matricola=:matricola and password=:password";
            $stm=$mypdo->prepare($query);
            $stm->bindValue(':matricola',$matricola,PDO::PARAM_STR);
            $stm->bindValue(':password',$password2,PDO::PARAM_STR);

            $result=$stm->execute();
            if($result){$user=$stm->fetch();
                if($user){return true;}               
            }
            else{return false;}
            $mypdo=null;


            
        }
        catch(PDOException $e){echo $e->getMessage();}

        }
        return false;
        
}
?>