<?php

if ($_SESSION['ruolo'] == 'docente') include 'rightBar.php';
if ($_SESSION['ruolo'] == 'studente') include 'notifiche.php';


?>