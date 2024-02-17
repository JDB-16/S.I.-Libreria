<?php
session_start();
include("../Datos/conexion.php");

$id_cliente = $_POST["id_cliente"];
$dni = $_POST["dni"];
$contrasena = $_POST["contrasena"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$localidad = $_POST["localidad"];
$pais = $_POST["pais"];
$direccion = $_POST["direccion"];
$id_sexo = $_POST["id_sexo"];
$id_metPago = $_POST["id_metPago"];
$id_prefEnvio = $_POST["id_prefEnvio"];
$id_modCompra = $_POST["id_modCompra"];

try {
    $consulta = $conexion->prepare("INSERT INTO cliente (id_Cliente, DNI, Contraseña, Nombres, Apellidos, Localidad, Pais, Direccion, id_Sexo, id_metPago, id_prefEnvio, id_modCompra)
    VALUES (:id_cliente, :dni, :contrasena, :nombres, :apellidos, :localidad, :pais, :direccion, :id_sexo, :id_metPago, :id_prefEnvio, :id_modCompra)");

    $consulta->bindParam(':id_cliente', $id_cliente);
    $consulta->bindParam(':dni', $dni);
    $consulta->bindParam(':contrasena', $contrasena);
    $consulta->bindParam(':nombres', $nombres);
    $consulta->bindParam(':apellidos', $apellidos);
    $consulta->bindParam(':localidad', $localidad);
    $consulta->bindParam(':pais', $pais);
    $consulta->bindParam(':direccion', $direccion);
    $consulta->bindParam(':id_sexo', $id_sexo);
    $consulta->bindParam(':id_metPago', $id_metPago);
    $consulta->bindParam(':id_prefEnvio', $id_prefEnvio);
    $consulta->bindParam(':id_modCompra', $id_modCompra);

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
