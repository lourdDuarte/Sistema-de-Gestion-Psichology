<?php
require_once '../../../class/Turno.php';
require_once '../../../class/MySQL.php';


//mostrar lista pacientes para comparar con id 
 $mysql = new MySQL();
            $query = 'SELECT paciente.id_paciente, persona.nombre, persona.apellido FROM paciente
			       INNER JOIN persona ON paciente.id_persona = persona.id_persona';
            $result = $mysql->consultar($query);
            $listaPaciente = array();
            while($r = mysqli_fetch_assoc($result)) {
                $listaPaciente[] = $r;
            }


$id = $_GET['idProfesional'];


$turno = new Turno();
$result = $turno->obtenerPorIdProfesional($id);
//$result = $turno->obtenerTodos();


$listadoTurnos = []; 
    $x = 0;
foreach($result as $item){
	foreach($listaPaciente as $paciente){
		if($item['id_paciente'] == $paciente['id_paciente']){
      		$listadoTurnos[$x]['title'] = $paciente['nombre']. " ". $paciente['apellido'];
  		}
    }
    	if($item['id_estado'] == 1){
    		$listadoTurnos[$x]['backgroundColor'] = 'red'; //no asiste el paciente
    	}
    	if($item['id_estado'] == 2){
    		$listadoTurnos[$x]['backgroundColor'] = 'green'; //no asiste el paciente
    	}
    	if($item['id_estado'] == 3){
    		$listadoTurnos[$x]['backgroundColor'] = 'orange'; //no asiste el paciente
    	}
    	if($item['id_estado'] == 4){
    		$listadoTurnos[$x]['backgroundColor'] = 'light blue'; //no asiste el paciente
    	}
    
    
    
      $listadoTurnos[$x]['id'] = $item['id_turno'];
      $listadoTurnos[$x]['start'] = $item['fecha'].'T'.$item['hora'];
      $listadoTurnos[$x]['end'] = $item['fecha'].'T'.$item['hora'];
      $x += 1; 
    
}

   echo json_encode($listadoTurnos);




   
   
?>


