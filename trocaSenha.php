<?php
if (!isset($_SESSION)){
    session_start();
}

require_once("control/CrtUsuario.php");
$crt_usuario = new CrtUsuario();
$atualizar_senha = $crt_usuario->alterarSenha();
$crt_usuario->protege();
//$crt_usuario->protege();

//if($_SERVER['REQUEST_METHOD'] == 'POST'){
//    $opcao = $_GET['acao'];
//    if($opcao == 'mudarSenha'){

//    }
//}

//if(isset($_GET['id'])){
//    $usuarios = $crt_usuario->showDadosForm();
//}
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
                $result = $crt_usuario->alterarSenha();
                echo $result[0];
            }
             ?>
              <div class="wrapper wrapper-content animated fadeIn">
                  <div class="row">
                      <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Alterar Senha</h5>
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
                            <form method="post" action="trocaSenha.php">
								<div class="ibox-content">
								<div class="row">
									<div class="col-sm-4">
										<label class="col-sm-0">Email</label>
										<input type="email" class="form-control" name="email" id="email" placeholder="Email do Usuario">
									</div>
									<div class="col-sm-4">
										<label class="col-sm-0">Senha Atual</label>
										<input type="password" class="form-control" name="senhaantiga" id="senhaantiga" placeholder="Senha Atual">
									</div>
									<div class="col-sm-4">
										<label class="col-sm-10">Nova Senha</label>
										<input type="password" class="form-control" name="senha" id="senha" placeholder="Nova Senha">
									</div>
									<!-- <div class="col-sm-4">
										<label class="col-sm-0">Confirmar Senha</label>
										<input type="password" class="form-control" name="conf_senha" id="conf_senha" placeholder="Confirmar Senha">
									</div> -->
								</div>
									<div class="hr-line-dashed"></div>
									<div class="row">
										<div class="col-sm-4">
											<button class="btn btn-primary" type="submit">Atualizar</button>
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
