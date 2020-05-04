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
  $mail->Subject='Scemo chi legge';
  $mail->Body='Suca';
  $mail->addAddress($name_mail);
  if($mail->send())
  {
    echo "La password è stata inviata a $name_mail.";;
  }
  else{echo "Ci sono stati problemi nell'invio della password, riprova per favore";}
}

?>