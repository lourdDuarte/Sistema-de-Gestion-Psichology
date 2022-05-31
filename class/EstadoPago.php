<?php

require_once 'MySQL.php';

class EstadoPago{
	private  $_idEstado;
	private  $_descripcion;

	public function __construct($descripcion) {
		$this->_descripcion = $descripcion;
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
    public function getDescripcion()
    {
        return $this->_descripcion;
    }

    /**
     * @param mixed $_descripcion
     *
     * @return self
     */
    public function setDescripcion($_descripcion)
    {
        $this->_descripcion = $_descripcion;

        return $this;
    }

    public function obtenerTodos(){

    	$sql = " SELECT * FROM estadoPago ";

    	$mysql = new MySQL();
    	$datos = $mysql->consultar($sql);
    	$mysql->desconectar();

    	$listado = self::_generarEstado($datos);
    	return $listado;

    }

    private function _generarEstado($datos){
    	$listado = array();
    	while ($registro = $datos->fetch_assoc()) {
    		$estado = new EstadoPago($registro['descripcion']);
    		$estado->_idEstado = $registro['id_estado'];
    		$listado[] = $estado;
    	}
    	return $listado;
    }

     public function __toString() {
    	return $this->_descripcion;
    }
}



?>