<?php
if (!isset($_SESSION)) {
session_start();
}
require_once("control/CrtUsuario.php");
$crt_usuario = new CrtUsuario();
$crt_usuario->protege();

$nome = $_SESSION['nome'];
$login = $_SESSION['login'];

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
                include ('./includes/menu.php')
                ?>

                <?php
                  $baseDir = 'uploads/';
                  $abreDir = ($_GET['dir'] != '' ? $_GET['dir'] : $baseDir);

                  //echo 'Abrir' . $abreDir;
                  $openDir = dir($abreDir);

                  $strrdir = strrpos(substr($abreDir, 0, -1), '/');
                  $backdir = substr($abreDir, 0, $strrdir+1);
                ?>
                    <div class="container">
                        <div class="wrapper wrapper-content animated fadeIn ">
                            <div class="row">
                              <div class="ibox-float-e-margins">
                                  <div class="col-lg-4">
                                      <div class="panel panel-warning">
                                          <div class="panel-heading">Informações do Usuário</div>
                                          <div class="panel-body">
                                            <p><?php
                                               echo "<strong>Nome:</strong> $nome";
                                            ?></p>
                                            <br/>
                                            <p><?php
                                               echo "<strong>Login:</strong> $login";
                                            ?></p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-lg-8">
                                    <div class="panel panel-warning">
                                      <div class="panel-body">
                                        <img src="bacelar.png" height="100px" width="600px" />
                                        <!--p>A Imagem vem aqui..</p>-->
                                      </div>

                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h4>Diretório</h4>
                                            <div class="ibox-tools">
                                              <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                              </a>
                                              <a class="close-link">
                                                <i class="fa fa-times"></i>
                                              </a>
                                            </div>
                                            <div class="col-sm-offset-6">
                                                <div class="input-group">
                                                    <input type="text" placeholder="Pesquisar" name="search_input" id="search_input" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <table class="footable table table-stripped toggle-arrow-tiny" id="tabela-arquivos">
                                                <thead>
                                                  <tr>
                                                      <th>Arquivo</th>
                                                      <th>Ação</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php
                                                      while ($arq = $openDir->read()):
                                                        if ($arq != '.' && $arq != '..'):
                                                            if(is_dir($abreDir.$arq)){
                                                              echo '<tr>';
                                                              echo '<td>'.$arq.'</td>';
                                                              echo '<td><a class="btn btn-xs btn-warning" href="dir.php?dir='.$abreDir.$arq.'/"><i class="fa fa-folder-open-o fa-2x"></i></a></td>';
                                                              echo '</tr>';
                                                             }else{
                                                              echo '<tr>';
                                                              echo '<td>'.$arq.'</td>';
                                                              echo '<td><a class="btn btn-xs btn-primary" target="_blank" href="'.$abreDir.$arq.'"><i class="fa fa-eye fa-2x"></i></a></td>';
                                                              echo '</tr>';
                                                            }
                                                         endif;
                                                      endwhile;
                                                   ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="5"  class="footable-visible">
                                                            <ul class="pagination pull-right"></ul>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <?php
                                              if($abreDir != $baseDir){
                                                  echo '<a class="btn btn-outline btn-info" href="dir.php?dir='.$backdir.'">Voltar</a>';
                                              }
                                              $openDir->close();
                                            ?>
                                        </div>
                                    </div>
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
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script>
    $('#search_input').bind('keyup click change', function () {
        search = $(this).val().toLowerCase();
        var re = new RegExp(search, 'g');

        $('#tabela-arquivos tbody tr').each(function () {
            $(this).hide();
            target = $(this).find('td').text().toLowerCase();
            if (target.match(re) || target.match('^' + search)) {
                $(this).show();
            }
        });
    });
    </script>

	<script src="assets/js/plugins/footable/footable.all.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();

        });

    </script>

</html>
