<?php 

require_once '../../class/Paciente.php';
require_once "../../menu.php";

$idPaciente = $_GET['id'];
$idFicha = $_GET['idFicha'];
$modulo = $_GET['modulo'];

$paciente = Paciente::obtenerPorId($idPaciente);

?>

<!DOCTYPE html>
<html>
<head>
	<title> Observaciones</title>

</head>
<body>
	<section id="main-content">
		<section class="wrapper">
	     <div class="row mt">
          <div class="col-lg-12">
            <h4><i class="fa fa-angle-right"></i> Nueva Observacion</h4>
            <div class="form-panel">
              <div class=" form">
              	<br>
		            <form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/guardar.php">
              			<input type="hidden" name="txtId" value="<?php echo $paciente->getIdPaciente(); ?>">
                    <input type="hidden" name="txtIdFicha" value='<?php echo $idFicha;?>'>
                    <input type="hidden" name="txtModulo" value='<?php echo $modulo;?>'>

			             <div class="row mt">
	                   <label class="col-lg-2 control-label">Observacion:</label>
                      <div class="col-lg-10">
				                <textarea name="txtDescripcion" cols="80" rows="10" ></textarea>
				              </div>
				            </div>
			
                  <div class="row mt">
                    <div class="col-lg-offset-2 col-lg-10">
                      <input type="submit" name="btnGuardar" value="Guardar">
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