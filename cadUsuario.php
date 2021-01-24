<?php
if (!isset($_SESSION)) {
  session_start();
}

//error_reporting(E_ALL);

require_once("control/CrtUsuario.php");
require_once("control/CrtPerfil.php");
$crt_usuario = new CrtUsuario();
$crt_perfil = new CrtPerfil();

$perfis = $crt_perfil->getAll();

$crt_usuario->protege();


// echo "<pre>";
// print_r($perfis);
// echo "</pre>";
?>


<!DOCTYPE html>
<html>
  <head>
    <?php
    include ('./includes/header.php');
    ?>
  </head>
  <body class="top-navigation">
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
          <?php
          include ('./includes/menu.php');
          ?>
          <div class="container">
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $result = $crt_usuario->cadastrar();
                echo $result[0];
            }
             ?>
              <div class="wrapper wrapper-content animated fadeIn">
                  <div class="row">
                      <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Cadastro de Usuário</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">Config option 1</a>
                                        </li>
                                        <li><a href="#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <form class="form-horizontal" action="cadUsuario.php" method="post">
                                <div class="ibox-content">
                                  <div class="row">
                                      <div class="col-sm-4">
                                        <label class="col-lg-1 control-label">Nome</label>
                                        <input type="text" name="nome" placeholder="Nome" required class="form-control"/>
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="col-lg-1 control-label">Usuário</label>
                                        <input type="text" placeholder="Usuário" name="login" required class="form-control"/>
                                      </div>
                                      <div class="col-sm-4">
                                        <label class="col-lg-1 control-label">Email</label>
                                        <input type="email" placeholder="Email" name="email" required class="form-control"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="ibox-content">
                                  <div class="row">
									<div class="col-sm-4">
                                      <label class="col-lg-1 control-label">OAB</label>
                                      <input type="text" name="oab" placeholder="OAB" class="form-control"/>
                                    </div>
                                    <div class="col-sm-4">
                                      <label class="col-lg-1 control-label">Senha</label>
                                      <input type="password" name="senha" placeholder="Senha" required class="form-control"/>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-sm-1 contol-label">Perfil</label>
                                        <select class="form-control" name="perfil">
                                          <option>Selecione..</option>
                                            <?php foreach ($perfis as $perfil){
                                                echo '<option value="'.$perfil['id_perfil'].'">'.$perfil['descricao'].'</option>';
                                            } ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="hr-line-dashed"></div>
                                  <div class="row">
                                      <div class="col-sm-4">
                                          <button type="submit" class="btn btn-success" name="button">Cadastrar</button>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </div>
    <?php
    include ('./includes/scripts.php');
    ?>
  </body>
</html>
