<?php

class Perfil {

    private $id;
    private $descricao;

    public function getId(){
      return $this->id;
    }

    public function setId($value)
    {
      $this->id = $value;
    }

    public function getDescricao()
    {
      return $this->descricao;
    }

    public function setDescricao($value)
    {
      $this->descricao = $value;
    }
}

?>
