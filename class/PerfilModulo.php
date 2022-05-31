<?php

require_once 'MySQL.php';

class PerfilModulo {

	private $_idPerfilModulo;
	private $_idPerfil;
	private $_idModulo;

    /**
     * @return mixed
     */
    public function getIdPerfilModulo()
    {
        return $this->_idPerfilModulo;
    }

    /**
     * @param mixed $_idPerfilModulo
     *
     * @return self
     */
    public function setIdPerfilModulo($_idPerfilModulo)
    {
        $this->_idPerfilModulo = $_idPerfilModulo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPerfil()
    {
        return $this->_idPerfil;
    }

    /**
     * @param mixed $_idPerfil
     *
     * @return self
     */
    public function setIdPerfil($_idPerfil)
    {
        $this->_idPerfil = $_idPerfil;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdModulo()
    {
        return $this->_idModulo;
    }

    /**
     * @param mixed $_idModulo
     *
     * @return self
     */
    public function setIdModulo($_idModulo)
    {
        $this->_idModulo = $_idModulo;

        return $this;
    }

    public function guardar() {
        $sql = "INSERT INTO perfil_modulo (id_perfil_modulo, id_perfil, id_modulo) "
             . "VALUES (NULL, $this->_idPerfil, $this->_idModulo)";

        $mysql = new MySQL();
        $idInsertado = $mysql->insertar($sql);

        $this->_idPerfilModulo = $idInsertado;
    }

    

}


?>