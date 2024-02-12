<?php
include("head.php");
include("navbar.php");
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST["id_cliente"];

    $nuevo_id = $_POST["nuevo_id"];
    $nuevo_dni = $_POST["nuevo_dni"];
    $nueva_contrasena = $_POST["nueva_contrasena"];
    $nuevo_nombre = $_POST["nuevo_nombre"];
    $nuevo_apellidos = $_POST["nuevo_apellidos"];
    $nuevo_direccion = $_POST["nuevo_direccion"];
    $nuevo_id_sexo = $_POST["nuevo_id_sexo"];

    $consulta = $conexion->prepare("UPDATE cliente 
                                    SET id_Cliente = :nuevo_id,
                                        DNI = :nuevo_dni, 
                                        Contraseña = :nueva_contrasena, 
                                        Nombres = :nuevo_nombre, 
                                        Apellidos = :nuevo_apellidos,
                                        Direccion = :nuevo_direccion, 
                                        id_Sexo = :nuevo_id_sexo
                                    WHERE id_Cliente = :id_cliente");

    $consulta->execute([
        ':nuevo_id' => $nuevo_id,
        ':nuevo_dni' => $nuevo_dni,
        ':nueva_contrasena' => $nueva_contrasena,
        ':nuevo_nombre' => $nuevo_nombre,
        ':nuevo_apellidos' => $nuevo_apellidos,
        ':nuevo_direccion' => $nuevo_direccion,        
        ':nuevo_id_sexo' => $nuevo_id_sexo,
        ':id_cliente' => $id_cliente
    ]);

        header("Location: formulario_editarC.php");
    exit();
} elseif (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];
    $consulta = $conexion->prepare("SELECT * FROM cliente WHERE id_Cliente = :id_cliente");
    $consulta->execute([':id_cliente' => $id_cliente]);
    $cliente = $consulta->fetch(PDO::FETCH_OBJ);
} else {
    header("Location: formulario_editarC.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<?php include("head.php"); ?>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Actualizar Datos de Cliente </h2>

        <form action="editarC.php" method="post">
            <input type="hidden" name="id_cliente" value="<?= $cliente->id_Cliente ?>">

            <div class="form-group">
                <label for="nuevo_id">ID Paciente:</label>
                <input type="text" name="nuevo_id" class="form-control" value="<?= $cliente->id_Cliente ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_dni">DNI:</label>
                <input type="text" name="nuevo_dni" class="form-control" value="<?= $cliente->DNI ?>" required>
            </div>

            <div class="form-group">
                <label for="nueva_contrasena">Contraseña:</label>
                <input type="password" name="nueva_contrasena" class="form-control" value="<?= $cliente->Contraseña ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_nombre">Nombres:</label>
                <input type="text" name="nuevo_nombre" class="form-control" value="<?= $cliente->Nombres ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_apellidos">Apellidos:</label>
                <input type="text" name="nuevo_apellidos" class="form-control" value="<?= $cliente->Apellidos ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_direccion">Direccion:</label>
                <input type="text" name="nuevo_direccion" class="form-control" value="<?= $cliente->Direccion ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_id_sexo">ID Sexo:</label>
                <input type="text" name="nuevo_id_sexo" class="form-control" value="<?= $cliente->id_Sexo ?>" required>
            </div>

            <div class="text-center mt-3 mb-4">
                <button type="submit" class="btn btn-celeste btn-lg mr-2">Actualizar</button>
                <a href="formulario_editarC.php" class="btn btn-celeste btn-lg mr-2">Regresar</a>
            </div>
            
        </form>
    </div>
</body>
</html>
