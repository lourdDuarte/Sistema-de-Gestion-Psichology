<?php

require_once '../../../class/MySQL.php';



$mysql = new MySQL();

$descripcion = $_POST['descripcion'];
$directorio =  $_POST['directorio'];

$validarDescripcion = " SELECT * FROM modulo WHERE descripcion = '$descripcion'"; 

$result1 = $mysql->consultar($validarDescripcion);
if(mysqli_num_rows($result1) > 0 ){
 	echo 1;
 }

$validarDirectorio = " SELECT * FROM modulo WHERE directorio = '$directorio' ";

$result2 = $mysql->consultar($validarDirectorio);
if(mysqli_num_rows($result2) > 0 ){
 	echo 2;
 } 

?>