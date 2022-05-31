<?php

require_once 'MySQL.php';

class EstadoTurno{
	private $_idEstado;
	private $_descripcion;

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
    	$sql = " SELECT * FROM estadoturno";

    	$mysql = new MySQL();
    	$datos = $mysql->consultar($sql);

    	$mysql->desconectar();

        $listado = self::_generarListadoEstado($datos);

        return $listado;
    }

    private function _generarListadoEstado($datos){
    	$listado = array();
    	while ($registro = $datos->fetch_assoc() ) {
    		$estado = new EstadoTurno();
    		$estado->_idEstado = $registro['id_estado'];
    		$estado->_descripcion = $registro['descripcion'];
    		$listado[] = $estado;
    	}
    	return $listado;
    }

     public function __toString() {
        return $this->_descripcion;
    }

}



?>