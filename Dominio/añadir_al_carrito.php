<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $id_producto = $_POST['id_producto'];

    $_SESSION['carrito'][] = $id_producto;

    header("Location: ../Presentador/formulario_productos.php");
    exit();
} else {
    header("Location: ../Presentador/formulario_productos.php");
    exit();
}
