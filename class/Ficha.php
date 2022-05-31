<?php

require_once 'MySQL.php';
//require_once 'DetalleFicha.php';

class Ficha
{
	private $_idFicha;
	private $_idPaciente;
    private $_idProfesional;
    private $_idTratamiento;
    private $_idTipoAtencion;
	private $_fechaAlta;

    
    /**
     * @return mixed
     */
    public function getIdFicha()
    {
        return $this->_idFicha;
    }

    /**
     * @param mixed $_idFicha
     *
     * @return self
     */
    public function setIdFicha($_idFicha)
    {
        $this->_idFicha = $_idFicha;

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
    public function getIdProfesional()
    {
        return $this->_idProfesional;
    }

    /**
     * @param mixed $_idProfesional
     *
     * @return self
     */
    public function setIdProfesional($_idProfesional)
    {
        $this->_idProfesional = $_idProfesional;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdTratamiento()
    {
        return $this->_idTratamiento;
    }

    /**
     * @param mixed $_idTratamiento
     *
     * @return self
     */
    public function setIdTratamiento($_idTratamiento)
    {
        $this->_idTratamiento = $_idTratamiento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechaAlta()
    {
        return $this->_fechaAlta;
    }

    /**
     * @param mixed $_fechaAlta
     *
     * @return self
     */
    public function setFechaAlta($_fechaAlta)
    {
        $this->_fechaAlta = $_fechaAlta;

        return $this;
    }
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

    public function guardar(){

    	$sql = " INSERT INTO ficha (id_ficha, id_paciente, id_profesional, id_tratamiento, id_tipo_atencion, fecha_alta) "
    		 . " VALUES (NULL, $this->_idPaciente, $this->_idProfesional,NULL, $this->_idTipoAtencion, '$this->_fechaAlta') ";

        //echo $sql;
    	$mysql = new MySQL();

    	$idInsertado = $mysql->insertar($sql);

    	$this->_idFicha = $idInsertado;
    }

    public function actualizar(){

    	$sql = " UPDATE ficha SET id_profesional = $this->_idProfesional, id_tipo_atencion = $this->_idTipoAtencion WHERE id_ficha = $this->_idFicha ";
        //echo $sql;
    	$mysql = new MySQL();

    	$mysql->actualizar($sql);
    }

     public function actualizarTratamiento(){

        $sql = " UPDATE ficha SET id_tratamiento = $this->_idTratamiento WHERE id_ficha = $this->_idFicha ";
        //echo $sql;
        $mysql = new MySQL();

        $mysql->actualizar($sql);
    }



    public function obtenerTodos(){
        $sql= " SELECT * FROM ficha ";

        $mysql= new MySQL();
        $datos=$mysql->consultar($sql);

        $mysql->desconectar();

        $listado = self::_generarListadoFicha($datos);

        return $listado;
    }


        public function obtenerPorIdPaciente($id){

            $sql = " SELECT * FROM ficha WHERE id_paciente = ".$id;
            $mysql = new MySQL();
            $datos = $mysql->consultar($sql);

            $mysql->desconectar();

            $listado= self::_generarListadoFicha($datos);

            return $listado;
        }

        private function _generarListadoFicha($datos) {
        $listado = array();
        while ($registro = $datos->fetch_assoc()) {
            $ficha = new Ficha();
            $ficha->_idFicha = $registro['id_ficha'];
            $ficha->_idPaciente = $registro['id_paciente'];
            $ficha->_idProfesional = $registro['id_profesional'];
            $ficha->_idTratamiento = $registro['id_tratamiento'];
            $ficha->_idTipoAtencion = $registro['id_tipo_atencion'];
            $ficha->_fechaAlta = $registro['fecha_alta'];
            $listado[] = $ficha;
        }
        return $listado;
    }

    public function obtenerPorId($id){

        $sql = " SELECT * FROM ficha WHERE id_ficha = ". $id;

        $mysql = new MySQL();
        $result = $mysql->consultar($sql);
        $mysql->desconectar();

        $data = $result->fetch_assoc();
        $ficha = self::_generarFicha($data);

        return $ficha;
    }

    private function _generarFicha($data){
        $ficha = new Ficha();
        $ficha->_idFicha = $data['id_ficha'];
        $ficha->_idPaciente = $data['id_paciente'];
        $ficha->_idProfesional = $data['id_profesional'];
        $ficha->_idTratamiento = $data['id_tratamiento'];
        $ficha->_idTipoAtencion = $data['id_tipo_atencion'];
        $ficha->_fechaAlta = $data['fecha_alta'];
        
        return $ficha;
    }
   

    
   

   

   





}

?>