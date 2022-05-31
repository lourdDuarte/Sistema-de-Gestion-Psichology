
<?php

require_once 'MySQL.php';


class TipoDocumento {

	private $_idTipoDocumento;
	private $_descripcion;

	public function __construct($descripcion) {
		$this->_descripcion = $descripcion;
	}

    /**
     * @return mixed
     */
    public function getIdTipoDocumento()
    {
        return $this->_idTipoDocumento;
    }

    /**
     * @param mixed $_idTipoDocumento
     *
     * @return self
     */
    public function setIdTipoDocumento($_idTipoDocumento)
    {
        $this->_idTipoDocumento = $_idTipoDocumento;

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

    public static function obtenerTodos() {
    	$sql = "SELECT * FROM tipodocumento";

    	$mysql = new MySQL();
    	$datos = $mysql->consultar($sql);
    	$mysql->desconectar();

    	$listado = self::_generarListado($datos);
    	return $listado;
    }

    private function _generarListado($datos) {
    	$listado = array();
		while ($registro = $datos->fetch_assoc()) {
			$tipoDocumento = new TipoDocumento($registro['descripcion']);
			$tipoDocumento->_idTipoDocumento = $registro['id_tipo_documento'];
			$listado[] = $tipoDocumento;
		}
		return $listado;
    }

    public static function obtenerPorId($id) {
        $sql = " SELECT * FROM tipodocumento WHERE id_tipo_documento = $id ";

        $mysql = new MySQL();
        $datos = $mysql->consultar($sql);
        $mysql->desconectar();

        $data = $datos->fetch_assoc();
        
        $tipoDocumento = new TipoDocumento($data['descripcion']);
        $tipoDocumento->_idTipoDocumento = $data['id_tipo_documento'];

        return $tipoDocumento;
    }

    public function __toString() {
    	return $this->_descripcion;
    }
}


?>