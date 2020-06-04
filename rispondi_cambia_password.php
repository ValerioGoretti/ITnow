<?php
    //php di risposta alla richiesta di cambio della password
    session_start();
    if(isset($_POST["submit"]))
    {
        if($_SESSION['ruolo']=='studente'){
        $matricola=$_SESSION['matricola'];
        
        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
        $p2=md5($_POST['up']);
        $np2=md5($_POST['np']);
        $query= "SELECT * 
                FROM studente 
                WHERE  password='$p2' and matricola='$matricola'";
        $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
        if(pg_num_rows($result)==1)
        {
            $array=array('password'=>$np2);
            $condition=array('matricola'=>$matricola);
            $res=pg_update($dbconn,'studente',$array,$condition)or die ('Query failed: '.pg_last_error());
            if ($res) header('Location: cambia_password_successo.php');
            else echo 'query fallita';
        }
        else{ 

             echo '<script language="javascript">
                    alert("Password precedente inserita non corretta.");
                    window.location.href="cambia_password.php";
                    </script>';
             

        }
        }
        else{
            if($_SESSION['ruolo']=='docente'){
                $matricola=$_SESSION['email'];
                
                $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
                $p2=md5($_POST['up']);
                $np2=md5($_POST['np']);
                $query= "SELECT * 
                        FROM docente 
                        WHERE  password='$p2' and email='$matricola'";
                $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
                if(pg_num_rows($result)==1)
                {
                    $array=array('password'=>$np2);
                    $condition=array('email'=>$matricola);
                    $res=pg_update($dbconn,'docente',$array,$condition)or die ('Query failed: '.pg_last_error());
                    if ($res) {header('Location: cambia_password_successo.php');}
                    else echo 'query fallita';
                }
                else{ 
        
                     echo '<script language="javascript">
                            alert("Password precedente inserita non corretta.");
                            window.location.href="cambia_password.php";
                            </script>';
                     
        
                }

        }
    }}
    else{header('Location: cambia_password.php');}
   
    pg_close($dbconn);
?>