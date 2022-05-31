<?php

require_once '../../../class/MySQL.php';



$mysql = new MySQL();

$matricula = $_POST['matricula'];
$numeroDocumento =  $_POST['numeroDocumento'];

$validarMatricula = " SELECT * FROM profesional "
     			  . " WHERE matricula = '$matricula'"; 

$result1 = $mysql->consultar($validarMatricula);

$validarNumeroDocumento = " SELECT * FROM persona WHERE numero_documento = '$numeroDocumento'";

$result2 = $mysql->consultar($validarNumeroDocumento);

if(mysqli_num_rows($result1) > 0 ){
 	echo 1;
 }else if(mysqli_num_rows($result2) > 0 ){
 	echo 2;
 } 

?>