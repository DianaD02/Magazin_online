<?php
$host='localhost';
$username='root';
$password='';
$db='magazin online';

$mysqli = new mysqli($host, $username, $password, $db);
if(!mysqli_connect_errno())
    echo 'Conectat la baza de date: '.$db;
else {
      echo 'Nu se poate conecta';
      exit();
    }
?>
