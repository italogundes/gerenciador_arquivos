<?php
require_once("library/data/DataBase.php");

class PerfilDAO extends DataBase {
    private $_tabela = "perfil";

    public function getAll()
    {
        return $this->db->select("SELECT * FROM {$this->_tabela}");
    }
}
