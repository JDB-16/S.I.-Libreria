<?php
    session_start();
    session_destroy();
    header('Location: ../Presentador/formulario_login.php')
?>