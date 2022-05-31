<?php


require_once 'MySQL.php';


class PagoOs{

	private $_idPago;
	private $_idPaciente;
	private $_idObraSocial;
	private $_sesionesAutorizadas;
  private $_sesionesAbonada;
  private $_montoSesion;
	private $_idEstado;
	private $_fecha;
	private $_total;

    /**
     * @return mixed
     */
    public function getIdPago()
    {
        return $this->_idPago;
    }

    /**
     * @param mixed $_idPago
     *
     * @return self
     */
    public function setIdPago($_idPago)
    {
        $this->_idPago = $_idPago;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPaciente()
    {
        return $this->_idPaciente;
    }

    /**
     * @param mixed $_idPaciente
     *
     * @return self
     */
    public function setIdPaciente($_idPaciente)
    {
        $this->_idPaciente = $_idPaciente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdObraSocial()
    {
        return $this->_idObraSocial;
    }

    /**
     * @param mixed $_idObraSocial
     *
     * @return self
     */
    public function setIdObraSocial($_idObraSocial)
    {
        $this->_idObraSocial = $_idObraSocial;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSesionesAutorizadas()
    {
        return $this->_sesionesAutorizadas;
    }

    /**
     * @param mixed $_sesionesAutorizadas
     *
     * @return self
     */
    public function setSesionesAutorizadas($_sesionesAutorizadas)
    {
        $this->_sesionesAutorizadas = $_sesionesAutorizadas;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSesionesAbonada()
    {
        return $this->_sesionesAbonada;
    }

    /**
     * @param mixed $_sesionesAbonada
     *
     * @return self
     */
    public function setSesionesAbonada($_sesionesAbonada)
    {
        $this->_sesionesAbonada = $_sesionesAbonada;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMontoSesion()
    {
        return $this->_montoSesion;
    }

    /**
     * @param mixed $_montoSesion
     *
     * @return self
     */
    public function setMontoSesion($_montoSesion)
    {
        $this->_montoSesion = $_montoSesion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdEstado()
    {
        return $this->_idEstado;
    }

    /**
     * @param mixed $_idEstado
     *
     * @return self
     */
    public function setIdEstado($_idEstado)
    {
        $this->_idEstado = $_idEstado;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->_fecha;
    }

    /**
     * @param mixed $_fecha
     *
     * @return self
     */
    public function setFecha($_fecha)
    {
        $this->_fecha = $_fecha;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->_total;
    }

    /**
     * @param mixed $_total
     *
     * @return self
     */
    public function setTotal($_total)
    {
        $this->_total = $_total;

        return $this;
    }

  

    public function calcularTotal($coSeguro){

    	$total = $coSeguro * $this->_sesionesAutorizadas;

    	return $total;

    }

    public function calcularAbonoPorSesion($coSeguro){

      $totalAbono = $coSeguro * $this->_sesionesAbonada;

      return $totalAbono;
    }


    public function guardar(){

    	$sql = " INSERT INTO PagoOS (id_pago, id_paciente, id_obra_social, sesiones_autorizadas, sesiones_abonada, "
           . " monto_sesion, fecha, id_estado, total) "
           . " VALUES (NULL, $this->_idPaciente, $this->_idObraSocial, $this->_sesionesAutorizadas, $this->_sesionesAbonada, "
           . " $this->_montoSesion, '$this->_fecha', NULL, $this->_total)";

    	echo $sql;

    	$mysql = new MySQL();

    	$idInsertado = $mysql->insertar($sql);

    	$this->_idPago = $idInsertado;
    }

  	public function actualizar(){

  		$sql = " UPDATE PagoOS SET id_obra_social = $this->_idObraSocial, "
           . " sesiones_autorizadas= $this->_sesionesAutorizadas, sesiones_abonada = $this->_sesionesAbonada, "
           . " monto_sesion = $this->_montoSesion, id_estado = $this->_idEstado "
           . " WHERE id_pago = $this->_idPago ";

      echo $sql;
  		$mysql = new MySQL();

  		$mysql->actualizar($sql);
  	}

  	public function obtenerTodos(){

  		$sql = " SELECT * FROM PagoOs ";

  		$mysql = new MySQL();
        $datos = $mysql->consultar($sql);
        $mysql->desconectar();

        $listado= self::_generarListadoPago($datos);

        return $listado;
  	}

  	private function _generarListadoPago($datos){

  		$listado = array();
  		while ($registro = $datos->fetch_assoc()){

  			$pago = new PagoOs();
  			$pago->_idPago = $registro['id_pago'];
  			$pago->_idPaciente = $registro['id_paciente'];
  			$pago->_idObraSocial = $registro['id_obra_social'];
  			$pago->_sesionesAutorizadas = $registro['sesiones_autorizadas'];
        $pago->_sesionesAbonada = $registro['sesiones_abonada'];
        $pago->_montoSesion = $registro['monto_sesion'];
  			$pago->_fecha = $registro['fecha'];
  			$pago->_idEstado = $registro['id_estado'];
  			$pago->_total= $registro['total'];
     
  			$listado[] = $pago;
  		}

  		return $listado;
  	} 

  	public function obtenerPorId($id){

  		$sql = " SELECT * FROM PagoOs WHERE id_pago = " . $id;

  		$mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        $data = $result->fetch_assoc();
        $pago = self::_generarPago($data);

        return $pago;
  	}

  	private function _generarPago($data){
  		$pago = new PagoOs();
  		$pago->_idPago = $data['id_pago'];
  		$pago->_idPaciente= $data['id_paciente'];
  		$pago->_idObraSocial = $data['id_obra_social'];
  		$pago->_sesionesAutorizadas = $data['sesiones_autorizadas'];
      $pago->_sesionesAbonada = $data['sesiones_abonada'];
      $pago->_montoSesion = $data['monto_sesion'];
  		$pago->_fecha = $data['fecha'];
  		$pago->_idEstado = $data['id_estado'];
  		$pago->_total = $data['total'];


  		return $pago;
  	}



public function actualizarEstado() {
      $sql = " UPDATE pagoOs SET id_estado = $this->_idEstado WHERE id_pago = $this->_idPago ";
      $mysql = new MySQL();
      $mysql->actualizar($sql);
    }

  
}

?>