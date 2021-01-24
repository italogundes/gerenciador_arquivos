<?php
ob_start();

//error_reporting(E_ALL);
require_once("./control/CrtUsuario.php");
$crt_usuario = new CrtUsuario();
 ?>

<div class="row border-bottom white-bg">
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <i class="fa fa-reorder"></i>
            </button>
            <a href="http://www.analiseti.com.br" target="_blank" class="navbar-brand">Análise TI</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="dir.php" class="dropdown-toggle" data-toggle="dropdown">Home</a>
                </li>
                <?php if($_SESSION['perfil_id'] == '1'){ ?>
                <li class="dropdown">
                    <a aria-expanded="false" role="button" href="cadUsuario.php" class="dropdown-toggle" data-toggle="dropdown">Usuários</a>
                </li>
              <?php } ?>
			  <li class="dropdown">
                    <a aria-expanded="false" role="button" href="trocaSenha.php" class="dropdown-toggle" data-toggle="dropdown">Alterar Senha</a>
                </li>
            </ul>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a id="btnSair">
                        <i class="fa fa-sign-out"></i> Sair
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<script src="assets/js/jquery-3.1.1.min.js"></script>
<script>
  $(function(){
      $('#btnSair').click(function (){
          $.ajax({
            url: 'control/sair.php',
          }).done(function(){
              window.location.href = "login.php";
          })
      });
  });
</script>
