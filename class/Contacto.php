<?php

require_once 'MySQL.php';




class Contacto {

	private $_idPersonaContacto;
	private $_idPersona;
	private $_idTipoContacto;
	private $_valor;

	private $_descripcion;

    /**
     * @return mixed
     */
    public function getIdPersonaContacto()
    {
        return $this->_idPersonaContacto;
    }

    /**
     * @param mixed $_idPersonaContacto
     *
     * @return self
     */
    public function setIdPersonaContacto($_idPersonaContacto)
    {
        $this->_idPersonaContacto = $_idPersonaContacto;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPersona()
    {
        return $this->_idPersona;
    }

    /**
     * @param mixed $_idPersona
     *
     * @return self
     */
    public function setIdPersona($_idPersona)
    {
        $this->_idPersona = $_idPersona;

        return $this;
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
    public function getValor()
    {
        return $this->_valor;
    }

    /**
     * @param mixed $_valor
     *
     * @return self
     */
    public function setValor($_valor)
    {
        $this->_valor = $_valor;

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

    public static function obtenerPorIdPersona($idPersona) {
        $sql = " SELECT persona_contacto.id_persona_contacto, persona_contacto.id_persona, "
             . " persona_contacto.id_tipo_contacto, persona_contacto.valor, "
             . " tipocontacto.descripcion "
             . " FROM persona_contacto "
             . " INNER JOIN tipocontacto on tipocontacto.id_tipo_contacto = persona_contacto.id_tipo_contacto "
             . " WHERE persona_contacto.id_persona = " .  $idPersona;

        //echo $sql;
        $mysql = new MySQL();
        $datos = $mysql->consultar($sql);
        $mysql->desconectar();

        $listado = self::_generarListadoContactos($datos);
        return $listado;        
    }

    private function _generarListadoContactos($datos) {
        $listado = array();
        while ($registro = $datos->fetch_assoc()) {
            $contacto = new Contacto();
            $contacto->_idPersonaContacto = $registro['id_persona_contacto'];
            $contacto->_idPersona = $registro['id_persona'];
            $contacto->_idTipoContacto = $registro['id_tipo_contacto'];
            $contacto->_valor = $registro['valor'];
            $contacto->_descripcion = $registro['descripcion'];
            $listado[] = $contacto;
        }
        return $listado;
    }


     public static function obtenerPorId($id){

        $sql = " SELECT * FROM persona_contacto WHERE id_persona_contacto = ".$id ;

        $mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        $data = $result->fetch_assoc();
        $contacto = self::_generarContacto($data);
        return $contacto;
    }

    private function _generarContacto($data) {

        $contacto = new Contacto();
        $contacto->_idPersonaContacto = $data['id_persona_contacto'];
        $contacto->_idPersona = $data['id_persona'];
        $contacto->_idTipoContacto = $data['id_tipo_contacto'];
        $contacto->_valor = $data['valor'];
        return $contacto;
    }

    public function guardar(){

        $sql= " INSERT INTO persona_contacto (id_persona_contacto, id_persona, id_tipo_contacto, valor ) "
            . " VALUES (NULL,$this->_idPersona, $this->_idTipoContacto, '$this->_valor' )";
        //echo $sql;

        $mysql= new MySQL;
        $idInsertado = $mysql->insertar($sql);

        $this->_idPersonaContacto = $idInsertado;
    }

    public function actualizar(){
    	$sql= " UPDATE persona_contacto set valor= '$this->_valor' WHERE id_persona = $this->_idPersona";
    }

    public function eliminar(){
        $sql = " DELETE FROM persona_contacto WHERE id_persona_contacto = $this->_idPersonaContacto ";

        echo $sql;

        $mysql = new MySQL();
        $mysql->eliminar($sql);
    }

    public function __toString() {
    	return $this->_valor .  " - " .  $this->_descripcion;
    }

}

?>