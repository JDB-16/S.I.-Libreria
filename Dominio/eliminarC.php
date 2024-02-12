<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id_paciente = $_GET['id'];

    $consulta = $conexion->prepare("DELETE FROM cliente WHERE id_Cliente = :id_cliente");
    $consulta->execute([':id_cliente' => $id_cliente]);


    if ($consulta->rowCount() > 0) {
        session_start();
    }

    header("Location: formulario_editarC.php");
    exit();
} else {
    header("Location: formulario_editarC.php");
    exit();
}
?>
