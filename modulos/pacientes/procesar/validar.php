<?php

require_once '../../../class/MySQL.php';



$mysql = new MySQL();

$numeroAsociado = $_POST['numeroAsociado'];
$numeroDocumento =  $_POST['numeroDocumento'];

$validarNumeroAsociado = " SELECT * FROM paciente_os WHERE numero_asociado = '$numeroAsociado'"; 

$result1 = $mysql->consultar($validarNumeroAsociado);
if(mysqli_num_rows($result1) > 0 ){
 	echo 1;
 }

$validarNumeroDocumento = " SELECT * FROM persona  WHERE numero_documento = '$numeroDocumento'";

$result2 = $mysql->consultar($validarNumeroDocumento);
if(mysqli_num_rows($result2) > 0 ){
 	echo 2;
 } 

?>