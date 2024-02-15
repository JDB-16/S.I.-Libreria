<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];

    if (isset($_SESSION['carrito']) && in_array($id_producto, $_SESSION['carrito'])) {
        $index = array_search($id_producto, $_SESSION['carrito']);
        unset($_SESSION['carrito'][$index]);

        header("Location: ../Presentador/ver_carrito.php");
        exit();
    } else {
        header("Location: ../Presentador/formulario_productos.php");
        exit();
    }
} else {

    header("Location: ../Presentador/formulario_productos.php");
    exit();
}
?>
