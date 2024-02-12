<?php
session_start();
include("conexion.php");

$id_producto = $_POST["id_producto"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];
$id_tipo = $_POST["id_tipo"];
$almacenamiento = $_POST["almacenamiento"];
$lectura = $_POST["lectura"];
$escritura = $_POST["escritura"];
$vida_operativa = $_POST["vida_operativa"];
$stock = $_POST["stock"];

try {
    $consulta = $conexion->prepare("INSERT INTO producto (id_Producto , Nombre, Descripcion, Precio, id_Tipo , Almacenamiento, Lectura, Escritura, Vida_Operativa, Stock)
    VALUES (:id_producto, :nombre, :descripcion, :precio, :id_tipo, :almacenamiento, :lectura, :escritura, :vida_operativa, :stock);");

    $consulta->bindParam(':id_producto', $id_producto);
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':descripcion', $descripcion);
    $consulta->bindParam(':precio', $precio);
    $consulta->bindParam(':id_tipo', $id_tipo);
    $consulta->bindParam(':almacenamiento', $almacenamiento);
    $consulta->bindParam(':lectura', $lectura);
    $consulta->bindParam(':escritura', $escritura);
    $consulta->bindParam(':vida_operativa', $vida_operativa);
    $consulta->bindParam(':stock', $stock);

    $consulta->execute();

    $_SESSION['mensaje'] = "Registro exitoso.";
    $_SESSION['mensaje_tipo'] = "success";

} catch (Exception $error) {
    $_SESSION['mensaje'] = "Error durante el registro. Revisa los datos e inténtalo de nuevo. <br> Detalles: " . $error->getMessage();
    $_SESSION['mensaje_tipo'] = "danger";
}

header("Location: formulario_crearP.php");
exit();
?>
