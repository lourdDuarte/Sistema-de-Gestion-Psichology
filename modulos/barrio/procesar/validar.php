<?php

require_once '../../../class/MySQL.php';



$mysql = new MySQL();

$nombre = $_POST['nombre'];


$validarBarrio = " SELECT * FROM barrio WHERE descripcion = '$nombre'"; 

$result = $mysql->consultar($validarBarrio);
if(mysqli_num_rows($result) > 0 ){
 	echo 1;
 }


?>