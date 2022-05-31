<?php

require_once '../../../class/MySQL.php';



$mysql = new MySQL();

$username = $_POST['username'];
$numeroDocumento =  $_POST['numeroDocumento'];

$validarUsuario = " SELECT * FROM usuario WHERE username = '$username'"; 

$result1 = $mysql->consultar($validarUsuario);
if(mysqli_num_rows($result1) > 0 ){
 	return 1;
 }

$validarNumeroDocumento = " SELECT * FROM  persona  WHERE numero_documento = '$numeroDocumento'";

$result2 = $mysql->consultar($validarNumeroDocumento);
if(mysqli_num_rows($result2) > 0 ){
 	return 2;
 } 

?>