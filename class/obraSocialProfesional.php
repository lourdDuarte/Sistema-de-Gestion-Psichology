<?php

require_once 'MySQL.php';

class obraSocialProfesional{
	private $_idObraSocialProfesional;
	private $_idObraSocial;
	private $_idProfesional;

    /**
     * @return mixed
     */
    public function getIdObraSocialProfesional()
    {
        return $this->_idObraSocialProfesional;
    }

    /**
     * @param mixed $_idObraSocialProfesional
     *
     * @return self
     */
    public function setIdObraSocialProfesional($_idObraSocialProfesional)
    {
        $this->_idObraSocialProfesional = $_idObraSocialProfesional;

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


    public function guardar(){
    	$sql= " INSERT INTO profesional_OS (id_obra_social_profesional, id_obra_social, id_profesional) "
    		. " VALUES (NULL, $this->_idObraSocial, $this->_idProfesional) ";

    	$mysql = new MySQL();

    	$idInsertado = $mysql->insertar($sql);

    	$this->_idObraSocialProfesional = $idInsertado;

    }



}



?>