<?php

require_once ("model/DAO/UsuarioDAO.php");
require_once ("model/Bean/Usuario.php");

class CrtUsuario {

  private $dao_usuario;
  private $usuario;
  private $msg;

  public function __construct() {
    $this->dao_usuario = new UsuarioDAO();
    $this->usuario = new Usuario();
    $this->msg = array();
  }

  public function autenticar() {
    $this->usuario->setLogin($_POST['usuario']);
    $this->usuario->setSenha(base64_encode(mhash(MHASH_SHA1, $_POST['senha'])));

    $logar = $this->dao_usuario->validaUsuario($this->usuario);

    if ($logar) {
      if ($logar[0]['login'] == $_POST['usuario'] and $logar[0]['passwd'] == base64_encode(mhash(MHASH_SHA1, $_POST['senha']))) {
        $tam = count($logar);

        if ($tam > 0) {
          $_SESSION['login'] = $logar[0]["login"];
          $_SESSION['id'] = $logar[0]["id"];
          $_SESSION['senha'] = $logar[0]["passwd"];
          $_SESSION['nome'] = $logar[0]["nome"];
          //$_SESSION['descricao'] = $logar[0]["descricao"];
          $_SESSION['perfil_id'] = $logar[0]["perfil_id"];
          //$_SESSION['dominio'] = $logar[0]["dominio"];
          //$_SESSION['local_trabalho'] = $logar[0]["local_trabalho"];

          return $logar[0]["perfil_id"];
        }


      } else {
        return false;
      }
    } else {
      return 'N';
    }
  }

  public function preencheGrid() {
    return $this->dao_usuario->preencheGrid();
  }

  public function cadastrar() {

    // print_r($_POST);
    // exit;

    $this->usuario->setNome($_POST['nome']);
    $this->usuario->setLogin($_POST['login']);
    $this->usuario->setSenha(base64_encode(mhash(MHASH_SHA1, $_POST['senha'])));
    $this->usuario->setPerfil(($_POST['perfil']=='')? 1 : $_POST['perfil']);
    $this->usuario->setEmail($_POST['email']);
	  $this->usuario->setOab($_POST['oab']);

    if ($this->dao_usuario->cadastrar($this->usuario) != -1) {
      $this->msg[] = "<div class='alert alert-success'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Sucess!</strong> Usuário inserido com sucesso!
      </div>";
    } else {
      $this->msg[] = "<div class='alert alert-danger'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Error!</strong> Erro ao inserir usuário!
      </div>";
    }

    return $this->msg;
  }

  public function getByUser($id){
    return $this->dao_usuario->getByUser($id);
  }


  public function atualizar() {
    $this->usuario->setNome($_POST['nome']);
    $this->usuario->setID($_POST['cod']);
    $this->usuario->setLogin($_POST['login']);
    $this->usuario->setPerfil($_POST['perfil']);
    $this->usuario->setEmail($_POST['email']);
	$this->usuario->setOab($_POST['oab']);
    if ($this->dao_usuario->atualizar($this->usuario)) {
      $this->msg[] = "<div class='alert alert-success'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Sucess!</strong> Usuário atualizado com sucesso!
      </div>";
    } else {
      $this->msg[] = "<div class='alert alert-danger'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Error!</strong> Erro ao atualizar usuário!
      </div>";
    }

    return $this->msg;
  }

  public function alterarSenha() {

	  //echo'<pre>';
	  //print_r($_POST);
	  //echo'</pre>';
	  //exit;

    $this->usuario->setSenha(base64_encode(mhash(MHASH_SHA1, $_POST['senha'])));
    $this->usuario->setEmail($_POST['email']);

    if ($this->dao_usuario->atualizarSenha($this->usuario) != -1) {
      $this->msg[] = "<div class='alert alert-success'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Sucess!</strong> Senha atualizada com sucesso!
      </div>";
    } else {
      $this->msg[] = "<div class='alert alert-danger'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Error!</strong> Erro ao atualizar senha!
      </div>";
    }

    return $this->msg;

  }

  public function showDadosForm() {
    $id = $_GET['id'];
    return $this->dao_usuario->showDadosForm($id);
  }

  public function getByPerfil($id_perfil) {
    return $this->dao_usuario->getByPerfil($id_perfil);
  }

  public function getByEmail() {
    $email = $_POST['email'];
    return $this->dao_usuario->getByEmail($email);
  }

  public function insereCodigo() {

    $this->usuario->setEmail($_POST['email']);
    $this->usuario->setCodigo_Verificacao($_POST['codigo_verificacao']);

    if ($this->dao_usuario->insereCodigo($this->usuario)) {
      $this->msg[] = "<div class='alert alert-success'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Sucess!</strong> Usuário atualizado com sucesso!
      </div>";
    } else {
      $this->msg[] = "<div class='alert alert-danger'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Error!</strong> Erro ao atualizar usuário!
      </div>";
    }

    return $this->msg;
  }

  public function atualizarSenhaEmail() {

    $this->usuario->setSenha(base64_encode(mhash(MHASH_SHA1, $_POST['novasenha'])));
    $this->usuario->setEmail($_POST['email']);

    if ($this->dao_usuario->atualizarSenhaEmail($this->usuario) != -1) {
      $this->msg[] = "<div class='alert alert-success'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Sucess!</strong> Usuário atualizado com sucesso!
      </div>";
    } else {
      $this->msg[] = "<div class='alert alert-danger'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Error!</strong> Erro ao atualizar usuário!
      </div>";
    }

    return $this->msg;
  }

  public function getById($idUsuario) {
    return $this->dao_usuario->getByid($idUsuario);
  }

  public function verificaPermissao($pagina) {

    $result = $this->dao_perfil_permissao->verificaPermissao($_SESSION['perfil_id'], $pagina);

    if (count($result) > 0) {
      return true;
    } else
    return false;
  }

  public function sair() {
    session_start();
    unset($_SESSION['usuario'], $_SESSION['senha']);
    session_destroy();
    header("Location: login.php");
  }

  public function protege() {
    if (!isset($_SESSION['login']) && (!isset($_SESSION['senha']))) {
      $this->expulsa();
    }
  }

  public function expulsa() {
    session_start();
    unset($_SESSION['login'], $_SESSION['senha']);
    session_destroy();
    header("Location: login.php");
  }

  public function remover($id) {
    echo $id;
    $this->dao_usuario->remover($id);
  }

  public function removerUsuario($id){
    if ($this->dao_usuario->remover($id)) {
      $this->msg[] = "<div class='alert alert-danger'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Erro!</strong> Não foi possível retirar o registro!
      </div>";
    } else {
      $this->msg[] = "<div class='alert alert-success'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Sucesso!</strong> Retirado com sucesso!
      </div>";
    }

    return $this->msg;
  }

  public function getAll() {
    return $this->dao_usuario->getAll();
  }

}

$class = new CrtUsuario();
