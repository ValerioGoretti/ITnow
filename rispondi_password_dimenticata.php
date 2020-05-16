<?php
//index.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';



if(isset($_POST["submit"]))
{
  $name_mail=$_POST['username'];
  

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
  $mail->Body='Gentile utente,
              \n il sistema ha modificato la password dimenticata e ne ha generata una di risserva per accedere al portale 
              \nPassword: \n
              Questa mail è stata generata automaticamente , si richiede di non rispodere.
              \nSaluti dallo staff di ITnow!
              ';
  $mail->addAddress($name_mail);
  if($mail->send())
  {
    
    readfile("password_dimenticata_invio.html");
    
  }
  else{readfile("password_dimenticata_fallimento.html");}


}

?>