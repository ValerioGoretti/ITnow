<?php
//index.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
$nuova=generateRandomString();


if(isset($_POST["submit"]))
{
  $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
  $docente=$_POST['valerio'];

  
  $name_mail=$_POST['email'];
  echo($docente);
  if($docente=='false'){
  
      $array=array('password'=>md5($nuova));
      $condition=array('email'=>$name_mail);
      $res=pg_update($dbconn,'studente',$array,$condition)or die ('Query failed: '.pg_last_error());
      if (!$res)  echo 'query fallita';
      
  }
  if($docente=='true'){
  
    $array=array('password'=>md5($nuova));
    $condition=array('email'=>$name_mail);
    $res=pg_update($dbconn,'docente',$array,$condition)or die ('Query failed: '.pg_last_error());
    if (!$res)  echo 'query fallita';
    
}


  }
  $name_mail=$_POST['email'];
  

  $mail = new PHPMailer();
  
  $mail->isSMTP();
  $mail->SMTPAuth=true;
  $mail->SMTPSecure='ssl';
  $mail->Host='out.virgilio.it';
  $mail->Port=465;
  $mail->isHTML(true);
  $mail->Username='itnow_@virgilio.it';
  $mail->Password='271071212.Epa';
  $mail->setFrom('itnow_@virgilio.it','ITnow');
  $mail->Subject='Invio password ITnow';
  $mail->Body='<html>
              <body>
              Gentile utente,
              <br>il sistema ha modificato la password dimenticata e ne ha generata una di risserva per accedere al portale 
              <br>
              <br>Password: '.$nuova.'
              <br>
              <br>
              <br>Questa mail è stata generata automaticamente , si richiede di non rispodere.
              <br>Saluti dallo staff di ITnow!
              </body>
              </html>
              ';
  $mail->addAddress($name_mail);
  if($mail->send())
  {
    
    readfile("password_dimenticata_invio.html");
    
  }
  else{readfile("password_dimenticata_fallimento.html");
  
  }



function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

?>