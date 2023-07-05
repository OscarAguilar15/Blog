<?php
$server="localhost";
$username='root';
$pass='';
$dbase='blog';
$db=mysqli_connect($server,$username,$pass,$dbase);

mysqli_query($db,"SET NAMES 'utf8'");

// iniciar sesion

session_start();