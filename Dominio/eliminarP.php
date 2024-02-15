<?php
include("../Datos/conexion.php");

if (isset($_GET['id'])) {
    $id_paciente = $_GET['id'];

    $consulta = $conexion->prepare("DELETE FROM producto WHERE id_Producto = :id_producto");
    $consulta->execute([':id_producto' => $id_producto]);

    if ($consulta->rowCount() > 0) {
        session_start();
    }

    header("Location: ../Presentador/formulario_editarP.php");
    exit();
} else {
    header("Location: ../Presentador/formulario_editarP.php");
    exit();
}
?>
