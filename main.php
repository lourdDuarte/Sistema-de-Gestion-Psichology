<?php
//require_once 'class/Paciente.php';
//require_once 'class/Profesional.php';
//require_once 'class/TipoEspecialidad.php';


//require_once 'class/Modulo.php';

//require_once 'class/Especialidad.php';

//$modulo = Modulo::obtenerTodos();

//highlight_string(var_export($modulo,true));




;
//$paciente= Paciente::obtenerPorId(2);
//obtenerPorIdProfesional(1);
//highlight_string(var_export($paciente,true));

//$Profesional=Profesional::obtenerProfesionalesPorEspecialidad(1);







require_once 'class/Usuario.php';



$registro = Usuario::obtenerTodos();

highlight_string(var_export($registro,true));



date_default_timezone_set('America/Argentina/Buenos_Aires');

echo date("Y-n-d");
=======
=======
>>>>>>> 21d8557726e78d895681add51afdbcfd09c980be
//require_once 'class/PagoOs.php';



//$registro = PagoOs::obtenerTodos();




//require_once 'class/Ficha.php';
//require_once 'class/DetalleFicha.php';

//$registro = Ficha::obtenerPorIdPaciente(28);

// echo $registro->getIdProfesional();
date_default_timezone_set('America/Argentina/Buenos_Aires');
echo strftime (" %d de %B de %Y");
echo "<br>";
echo date("Y-n-d");
	

//highlight_string(var_export($registro,true));

<<<<<<< HEAD
>>>>>>> 21d8557726e78d895681add51afdbcfd09c980be
=======
>>>>>>> 21d8557726e78d895681add51afdbcfd09c980be
?>


  