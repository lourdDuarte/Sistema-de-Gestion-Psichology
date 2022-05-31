<?php

require_once '../../../class/MySQL.php';



$mysql = new MySQL();

$tipo = $_POST['tipo'];


$validarEspecialidad = " SELECT * FROM especialidad WHERE tipo = '$tipo'"; 

$result = $mysql->consultar($validarEspecialidad);
if(mysqli_num_rows($result) > 0 ){
 	echo 1;
 }


?>