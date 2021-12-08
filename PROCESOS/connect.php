<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'laboratorio-medico';

$mysqli = mysqli_connect("localhost", "root", "", "laboratorio-medico");

if($mysqli){
    //echo '<script>alert("yes")</script>';
} else {
   // echo '<script>alert("no")</script>';
}

?>