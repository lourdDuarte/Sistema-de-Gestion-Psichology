<?php

require_once '../../../class/MySQL.php';



$mysql = new MySQL();

$valor = $_POST['valor'];


$validarContacto= " SELECT * FROM persona_contacto WHERE valor = '$valor'"; 

$result = $mysql->consultar($validarContacto);
if(mysqli_num_rows($result) > 0 ){
 	echo 1;
 }


?>