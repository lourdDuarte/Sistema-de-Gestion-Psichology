<?php

require_once '../../class/Tratamiento.php';
require_once '../../menu.php';

$id=$_GET['id'];
$idLlamada = $_GET['paciente']; 
$modulo = $_GET['modulo'];
$ficha =$_GET['ficha'];

$tratamiento= Tratamiento::obtenerPorId($id);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Actualizar Tratamiento</title>
</head>
<body>

<section id="main-content">
    <section class="wrapper">
    <div class="row mt">
      <div class="col-lg-12">
       <h4><i class="fa fa-angle-right"></i> Actualizar Tratamiento</h4>
       <div class="form-panel">
          <div class=" form">
       	    <br>
		        <form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action ="procesar/modificar.php">

          		<input type="hidden" name="txtId" value="<?php echo $tratamiento->getIdTratamiento(); ?>">
              <input type="hidden" name="txtLlamada" value="<?php echo $idLlamada; ?>">
              <input type="hidden" name="txtFicha" value="<?php echo $ficha; ?>">
              <input type="hidden" name="txtModulo" value="<?php echo $modulo; ?>">
		          <div class="row mt">
                <label class="col-lg-2 control-label">Tipo</label>
                <div class="col-lg-10">
					       <input type="text" name="txtTipo" value= "<?php echo $tratamiento->getTipo(); ?>"class="form-control">
					     </div>
				      </div>
				      <div class="row mt">
                <label class="col-lg-2 control-label">Observacion</label>
                <div class="col-lg-10">
					         <input type="text" name="txtObservacion" value= "<?php echo $tratamiento->getObservacion();?>"class="form-control">
					       </div>
				        </div>
				        <div align="left">
                  <div class="row mt">
                    <div class="col-lg-offset-2 col-lg-10">
                       <input type="submit" name="btnGuardar" value="Actualizar">
                   </div>
                  </div>
              	</div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</section>
</body>
</html>