<?php
    session_start();
    unset($_SESSION['usuario'], $_SESSION['senha']);
    session_destroy();
    //header("Location: login.php");
    //echo '<script>window.location.href = "login.php";</script>';
?>
