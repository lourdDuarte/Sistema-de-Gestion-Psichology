<?php

require_once 'Mysql.php';
require_once 'Domicilio.php';
require_once 'Contacto.php';
require_once 'TipoDocumento.php';


class Persona{
	protected $_idPersona;
	protected $_nombre;
	protected $_apellido;
	protected $_fechaNacimiento;
	protected $_numeroDocumento;
	protected $_idTipoDocumento;
	protected $_estado;

    public $domicilio;
    public $tipoDocumento;
    public $arrContactos;


	const ACTIVO = 1;

	public function __construct($nombre, $apellido) {
		$this->_nombre = $nombre;
		$this->_apellido = $apellido;
		$this->_estado = self::ACTIVO;
	}

    /**
     * @return mixed
     */
    public function getIdPersona()
    {
        return $this->_idPersona;
    }
    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->_nombre;
    }

    /**
     * @param mixed $_nombre
     *
     * @return self
     */
    public function setNombre($_nombre)
    {
        $this->_nombre = $_nombre;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->_apellido;
    }

    /**
     * @param mixed $_apellido
     *
     * @return self
     */
    public function setApellido($_apellido)
    {
        $this->_apellido = $_apellido;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->_fechaNacimiento;
    }

    /**
     * @param mixed $_fechaNacimiento
     *
     * @return self
     */
    public function setFechaNacimiento($_fechaNacimiento)
    {
        $this->_fechaNacimiento = $_fechaNacimiento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroDocumento()
    {
        return $this->_numeroDocumento;
    }

    /**
     * @param mixed $_numeroDocumento
     *
     * @return self
     */
    public function setNumeroDocumento($_numeroDocumento)
    {
        $this->_numeroDocumento = $_numeroDocumento;

        return $this;
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
    public function getEstado()
    {
        return $this->_estado;
    }

    /**
     * @param mixed $_estado
     *
     * @return self
     */
    public function setEstado($_estado)
    {
        $this->_estado = $_estado;

        return $this;
    }





	public function guardar() {
        $sql = " INSERT INTO Persona (id_persona, nombre, apellido,id_tipo_documento, "
             . " numero_documento, fecha_nacimiento) VALUES (NULL, '$this->_nombre', "
             . " '$this->_apellido', '$this->_idTipoDocumento', '$this->_numeroDocumento', '$this->_fechaNacimiento')";

        //echo $sql;
        $mysql = new MySQL();
        $idInsertado = $mysql->insertar($sql);

        $this->_idPersona = $idInsertado;

    }

    public function actualizar() {
        $sql = "UPDATE Persona SET nombre = '$this->_nombre', apellido = '$this->_apellido', "
             ." id_tipo_documento = $this->_idTipoDocumento, numero_documento = '$this->_numeroDocumento', fecha_nacimiento = '$this->_fechaNacimiento' "
             . "WHERE id_persona = $this->_idPersona";

        //echo $sql;
        $mysql = new MySQL();
        $mysql->actualizar($sql);

    }

    public function eliminar() {

        $sql= "DELETE FROM Persona"
        ."WHERE id_persona = $this->_idPersona";

        $mysql= new MySQL();
        $mysql->eliminar($sql);

    }

    public function setDomicilio() {
        $this->domicilio = Domicilio::obtenerPorIdPersona($this->_idPersona);
    }

    public function setTipoDocumento() {
        if (!is_null($this->_idTipoDocumento)) {
            $this->tipoDocumento = TipoDocumento::obtenerPorId($this->_idTipoDocumento);
        }
    }


    public function setContactos() {
        $this->arrContactos = Contacto::obtenerPorIdPersona($this->_idPersona);
    }




    public function __toString() {
    	return $this->_nombre . ", " . $this->_apellido;
    }





 



}



?>