<?php
require 'connect.php';
session_start();

if($_SESSION['rango'] == 1){
    header('location: ../home/home_medico.php');
} else {
    header('location: ../home/home_enfermero.php');
}


?>