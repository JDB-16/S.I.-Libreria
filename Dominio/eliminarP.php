<?php
include("../Datos/conexion.php");

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    $consulta = $conexion->prepare("DELETE FROM libro WHERE id_Producto = :id_producto");
    $consulta->execute([':id_producto' => $id_producto]);

    header("Location: ../Presentador/formulario_editarP.php");
    exit();
} else {
    header("Location: ../Presentador/formulario_editarP.php");
    exit();
}
?>
