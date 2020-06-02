<?php $data = $_POST['image'];
session_start();

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);


$data = base64_decode($data);
$imageName = time().'.png';
if($_SESSION['ruolo']=='docente'){$imageName =$_SESSION['email'].'.png';}
if($_SESSION['ruolo']=='studente'){$imageName =$_SESSION['matricola'].'.png';}
file_put_contents('img_docente/'.$imageName, $data);


echo $imageName;?>