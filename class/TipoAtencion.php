
<?php 

require_once 'MySQL.php';

class TipoAtencion{

	private $_idTipoAtencion;
	private $_descripcion;

    /**
     * @return mixed
     */
    public function getIdTipoAtencion()
    {
        return $this->_idTipoAtencion;
    }

    /**
     * @param mixed $_idTipoAtencion
     *
     * @return self
     */
    public function setIdTipoAtencion($_idTipoAtencion)
    {
        $this->_idTipoAtencion = $_idTipoAtencion;

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
    	$sql = " SELECT * FROM tipoAtencion";

    	$mysql = new MySQL();

    	$datos = $mysql->consultar($sql);
    	$listado = self::_generarTipoAtencion($datos);

        return $listado;
    }

    private function _generarTipoAtencion($datos) {
        $listado = array();
        while ($registro = $datos->fetch_assoc()) {
            $tipoAtencion = new TipoAtencion();
            $tipoAtencion->_idTipoAtencion = $registro['id_tipo_atencion'];
            $tipoAtencion->_descripcion = $registro['descripcion'];
            $listado[] = $tipoAtencion;
        }
        return $listado;
    }

      public function __toString() {
        return $this->_descripcion;
    }
}

?>