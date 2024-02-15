<?php
session_start();
include("../Datos/conexion.php");

$id_cliente = $_POST["id_cliente"];
$dni = $_POST["dni"];
$contrasena = $_POST["contrasena"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$direccion = $_POST["direccion"];
$id_sexo = $_POST["id_sexo"];

try {
    $consulta = $conexion->prepare("INSERT INTO cliente (id_Cliente, DNI, Contraseña, Nombres, Apellidos, Direccion, id_Sexo)
    VALUES (:id_cliente, :dni, :contrasena, :nombres, :apellidos, :direccion, :id_sexo);");

    $consulta->bindParam(':id_cliente', $id_cliente);
    $consulta->bindParam(':dni', $dni);
    $consulta->bindParam(':contrasena', $contrasena);
    $consulta->bindParam(':nombres', $nombres);
    $consulta->bindParam(':apellidos', $apellidos);
    $consulta->bindParam(':direccion', $direccion);
    $consulta->bindParam(':id_sexo', $id_sexo);

    $consulta->execute();

    $_SESSION['mensaje'] = "Registro exitoso.";
    $_SESSION['mensaje_tipo'] = "success";

} catch (Exception $error) {
    $_SESSION['mensaje'] = "Error durante el registro. Revisa los datos e inténtalo de nuevo. <br> Detalles: " . $error->getMessage();
    $_SESSION['mensaje_tipo'] = "danger";
}

header("Location: ../Presentador/formulario_crear.php");
exit();
?>
