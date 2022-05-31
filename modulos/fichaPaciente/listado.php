<?php 

require_once '../../menu.php';
require_once '../../class/Ficha.php';
require_once '../../class/Paciente.php';


$listadoFichas = Ficha::obtenerTodos();
$listaPaciente = Paciente::obtenerTodos();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<section id="main-content">
    <section class="wrapper">
       <h3><i class="fa fa-angle-right"></i>Fichas Paciente</h3>
        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <hr>
                    <thead>
                      <tr>
                	       <th><i class="fa fa-bullhorn"></i>ID Ficha</th>
              					<th><i class="fa fa-bullhorn"></i>Paciente</th>
              					<th><i class="fa fa-bullhorn"></i>Fecha Admision</th>
              					<th><i class="fa fa-bullhorn"></i>Acciones</th>
				              </tr>
				            </thead>
                    <tbody>
                       <?php foreach($listadoFichas as $ficha): ?>
                	     <td> <?php echo $ficha->getIdFicha(); ?> </td>

                        <?php 
                        foreach ($listaPaciente as $paciente):
                          $pacienteId = ' ';
                       
                          if ($ficha->getIdPaciente() == $paciente->getIdPaciente()): 
                            $pacienteId = $paciente->getIdPaciente();
                            $pacientes = Paciente::obtenerPorId($pacienteId)
                            
                    
                        ?>
					             <td> <?php echo $pacientes; ?> </td>
					             <td><?php echo $ficha->getFechaAlta();?></td>
				              <?php endif?>
					           <?php endforeach?>
					             <td>
						              <a href="detalleFicha.php?id=<?php echo $ficha->getIdFicha();?>&idPaciente=<?php echo $ficha->getIdPaciente();?>">
                      	 <button type="button" class="btn btn-primary">Ver Detalles</button>
                    	   </a>
							
					               </td>
				              </tr>

		                <?php endforeach ?>
	                 </tbody>
                  </table>
              </div>
            </div>
          </div>
    </section>
  </section>
</body>
</html>