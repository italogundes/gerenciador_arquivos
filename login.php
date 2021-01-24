<?php
ob_start();
session_start();
//error_reporting(E_ALL);
require_once("control/CrtUsuario.php");
$crt_usuario = new CrtUsuario();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $return = $crt_usuario->autenticar();

    if ($return == (1 || 2)) {
        header("Location: dir.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BACELAR | Login </title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>
<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Bacelar Advocacia</h2>

                <p>
                    <strong><i>Sistema para Gerenciamento de Arquivos.</i></strong>
                </p>
                <br/>
                <p>
                  <strong>Endereço:</strong> <i>R. do Passeio, 823 - Centro, São Luís - MA.</i> <br/>
                  <br/>
                  <strong>CEP:</strong> <i>65015-370.</i> <br/>
                  <br/>
                  <strong>Telefone:</strong> <i>(98) 3221-3027.</i>
                </p>
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" method="post" action="login.php">
                        <div class="form-group">
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" required="" title="Usuário">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required="" title="Senha">
                        </div>
                        <!--button type="submit" class="btn btn-primary block full-width m-b">Login</button>-->

                        <!--a href="#">
                            <small>Forgot password?</small>
                        </a>-->

                        <!--p class="text-muted text-center">
                            <small>Não tem uma Conta?</small>
                        </p>-->
                        <!--a class="btn btn-sm btn-white btn-block" href="register.html">Criar Conta</a>-->
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                    </form>
                    <p class="m-t">
                        <small>Sistema desenvolvido por <a href="http://analiseti.com.br" target="_blank"/>Análise TI </a> &copy; 2019</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Análise TI - Tecnologia & Treinamento.
            </div>
            <div class="col-md-6 text-right">
               <small>© 2018</small>
            </div>
        </div>
    </div>

</body>

</html>
