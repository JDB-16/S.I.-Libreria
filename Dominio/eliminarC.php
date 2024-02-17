<?php
include("../Datos/conexion.php");

if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    $consulta = $conexion->prepare("DELETE FROM cliente WHERE id_Cliente = :id_cliente");
    $consulta->execute([':id_cliente' => $id_cliente]);

    header("Location: ../Presentador/formulario_editarC.php");
    exit();
} else {
    header("Location: ../Presentador/formulario_editarC.php");
    exit();
}
?>
