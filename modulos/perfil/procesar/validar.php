<?php

require_once '../../../class/MySQL.php';



$mysql = new MySQL();

$descripcion = $_POST['descripcion'];


$validarPerfil = " SELECT * FROM perfil WHERE descripcion = '$descripcion'"; 

$result = $mysql->consultar($validarPerfil);
if(mysqli_num_rows($result) > 0 ){
 	echo 1;
 }


?>