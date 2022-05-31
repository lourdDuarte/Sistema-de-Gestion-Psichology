
<?php

require_once "MySQL.php";

class TipoContacto{

	private $_idTipoContacto;
	private $_descripcion;


	public function __construct($descripcion){
		$this ->_descripcion = $descripcion;
	}


    /**
     * @return mixed
     */
    public function getIdTipoContacto()
    {
        return $this->_idTipoContacto;
    }

    /**
     * @param mixed $_idTipoContacto
     *
     * @return self
     */
    public function setIdTipoContacto($_idTipoContacto)
    {
        $this->_idTipoContacto = $_idTipoContacto;

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
    	$sql = " SELECT * FROM tipocontacto";

    	//echo $sql;

    	$mysql= new MySQL;
    	$datos= $mysql->consultar($sql);
    	$mysql->desconectar();

    	$listado= self::_generarListado($datos);
    	return $listado;
    }

    private  function _generarListado($datos){
    	$listado= array();
		while ($registro = $datos->fetch_assoc()) {
    		$tipoContacto= new TipoContacto($registro['descripcion']);
    		$tipoContacto->_idTipoContacto= $registro['id_tipo_contacto'];
    		$listado[]= $tipoContacto;
    	}
    	return $listado;

    }

    public function __toString() {
    	return $this->_descripcion;
    }

}

?>