<?php

require_once '../../class/Tratamiento.php';
require_once '../../class/Ficha.php';
require_once '../../menu.php';

$id = $_GET['id'];

$ficha = Ficha::obtenerPorId($id);
$idLlamada = $_GET['idLlamada'];
$moduloLlamada = $_GET['modulo'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Alta tratamiento</title>
</head>
<body>
  <section id="main-content">
    <section class="wrapper">
      <div class="row mt">
        <div class="col-lg-12">
          <h4><i class="fa fa-angle-right"></i> Nuevo Tratamiento</h4>
          <div class="form-panel">
            <div class=" form">
       	      <br>
		          <form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/guardar.php">
                <input type="hidden" name="txtId" value="<?php echo $ficha->getIdFicha(); ?>">
                <input type="hidden" name="txtIdLlamada" value='<?php echo $idLlamada;?>'>
                <input type="hidden" name="txtModulo" value='<?php echo $moduloLlamada;?>'>
			           <div class="row mt">
                    <label class="col-lg-2 control-label">Tipo</label>
                    <div class="col-lg-10">
					           <input type="text" name="txtTipo" class="form-control">
					         </div>
				          </div>
				          <div class="row mt">
                 	  <label class="col-lg-2 control-label">Observacion</label>
                 	  <div class="col-lg-10">
					           <input type="text" name="txtObservacion" class="form-control">
					         </div>
				          </div>
			           <div align="left">
                    <div class="row mt">
                      <div class="col-lg-offset-2 col-lg-10">
                        <input type="submit" name="btnGuardar" value="Guardar">
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