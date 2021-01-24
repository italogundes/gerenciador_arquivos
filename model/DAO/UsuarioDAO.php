<?php

require_once("library/data/DataBase.php");

class UsuarioDAO extends DataBase {

    private $_tabela = "usuarios";

    // Retorna todos os contatos

    public function getAll() {
        return $this->db->select("SELECT * FROM {$this->_tabela} where perfil_id <> 11");
    }


    public function getByid($id) {
        $id = (int) $id;
        return $this->db->select("SELECT * FROM {$this->_tabela} inner join perfil on perfil_id = perfil.id_perfil WHERE id = :id", array(':id' => $id), FALSE);
    }

    public function getByUser($id){
        $id = (string) $id;
        return $this->db->select("select nome from {$this->_tabela} where login = :login ", array(':login'=> $id));
    }
    public function showDadosForm($id) {
        $id = (int) $id;
        return $this->db->select("SELECT nome, users_front.id, perfil_id, login, email, perfil.id_perfil, descricao, crm  FROM {$this->_tabela} inner join perfil on perfil_id = perfil.id_perfil WHERE users_front.id = :id", array(':id' => $id), FALSE);
    }

    public function getByPerfil($id_perfil) {
        return $this->db->select("select * from {$this->_tabela} users_front
	inner join perfil on perfil_id = perfil.id
        where users_front.id= :id", array(':id' => $id_perfil), FALSE);
    }

    public function getByEmail($email) {

        return $this->db->select("SELECT * FROM {$this->_tabela} WHERE email = :email", array(':email' => $email), FALSE);
    }

    public function cadastrar(Usuario $usuario) {
        $valores = array(
            'nome' => $usuario->getNome(),
            'login' => $usuario->getLogin(),
            'passwd' => $usuario->getSenha(),
            'perfil_id' => $usuario->getPerfil(),
            'email' => $usuario->getEmail(),
			'oab'=> $usuario->getOab()
        );

        return $this->db->insert($this->_tabela, $valores);
    }

    public function atualizar(Usuario $usuario) {
        $valores = array('nome' => $usuario->getNome(),
                        'login'=>$usuario->getlogin(),
                        'perfil_id' => $usuario->getPerfil(),
                        'email' => $usuario->getEmail()
                        );
        $where = "id = " . (int) $usuario->getID();

        return $this->db->update($this->_tabela, $valores, $where);
    }

    public function atualizarSenhaEmail(Usuario $usuario) {
        $valores = array(
            'passwd' => $usuario->getSenha(),
            'senha' => $usuario->getSenha());
        $where = "email = '" . $usuario->getEmail() . "'";

        return $this->db->update($this->_tabela, $valores, $where);
    }

    public function insereCodigo(Usuario $usuario) {
        $valores = array(
            'codigo_verificacao' => $usuario->getCodigo_Verificacao(),
        );
        $where = "email = '" . $usuario->getEmail() . "'";

        return $this->db->update($this->_tabela, $valores, $where);
    }

    public function atualizarSenha(Usuario $usuario) {
        $valores = array('passwd' => $usuario->getSenha());
        $where = "email = '" . $usuario->getEmail() . "'";

        return $this->db->update($this->_tabela, $valores, $where);
    }

    public function preencheGrid() {
        return $this->db->select("select usr.id as id,
    			 usr.nome as nome,
    			 usr.login as login,
    			 usr.perfil_id as perfil_id,
    			 per.descricao as perfil
    			 from users_front as usr
    			 left join perfil as per on per.id_perfil = usr.perfil_id");
    }

    public function validaUsuario(Usuario $usuario) {

        $where = array(
            ':login' => $usuario->getLogin(),
            ':senha' => $usuario->getSenha()
        );

        $logar = $this->db->select("SELECT * FROM {$this->_tabela} inner join perfil on perfil_id = perfil.id_perfil WHERE login = :login AND passwd = :senha", $where);


        return $logar;
    }


    public function remover($id) {
        $sucess = true;
        $id = (int) $id;
        $qtd = $this->getQtdUsuariosVisualizacao($id);

        $this->db->beginTransaction();
try {
  if ($qtd[0]["qtd"] > 0) {
      $this->db->delete('tb_visualizacao_permissao', "fk_idusuario = $id");

      $delUser = $this->db->delete($this->_tabela, "id = $id");

  }

  $this->db->commit();

  return $sucess;
} catch (\Exception $e) {
  $this->db->rollBack();

  return $e;
}


    }

    public function removerUsuario($id){
        return $this->db->delete($this->_tabela, "id = $id");
    }
}
