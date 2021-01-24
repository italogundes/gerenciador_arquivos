<?php
require_once ("model/DAO/PerfilDAO.php");
require_once ("model/Bean/Perfil.php");


class CrtPerfil{

    private $dao_perfil;
    private $perfil;
    private $msg;

    public function __construct() {
        $this->dao_perfil = new PerfilDAO();
        $this->msg = array();
        $this->perfil = new Perfil();
    }

    public function getAll() {
        return $this->dao_perfil->getAll();
    }
}
?>
