<?php
session_start();
include("../Datos/conexion.php");

$id_producto = $_POST["id_producto"];
$nombre = $_POST["nombre"];
$sinopsis = $_POST["sinopsis"];
$autor = $_POST["autor"];
$precio = $_POST["precio"];
$fecha_publicacion = $_POST["fecha_publicacion"];
$stock = $_POST["stock"];

try {
    $consulta = $conexion->prepare("INSERT INTO libro (id_Producto, Nombre, Sinopsis, Autor, Precio, FechaPublicacion, Stock)
    VALUES (:id_producto, :nombre, :sinopsis, :autor, :precio, :fecha_publicacion, :stock)");

    $consulta->bindParam(':id_producto', $id_producto);
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':sinopsis', $sinopsis);
    $consulta->bindParam(':autor', $autor);
    $consulta->bindParam(':precio', $precio);
    $consulta->bindParam(':fecha_publicacion', $fecha_publicacion);
    $consulta->bindParam(':stock', $stock);

    $consulta->execute();

    $_SESSION['mensaje'] = "Registro exitoso.";
    $_SESSION['mensaje_tipo'] = "success";

} catch (Exception $error) {
    $_SESSION['mensaje'] = "Error durante el registro. Revisa los datos e inténtalo de nuevo. <br> Detalles: " . $error->getMessage();
    $_SESSION['mensaje_tipo'] = "danger";
}

header("Location: ../Presentador/formulario_crearP.php");
exit();
?>
