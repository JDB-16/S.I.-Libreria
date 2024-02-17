<?php
include("../Datos/head.php");
include("../Datos/navbar.php");
include("../Datos/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST["id_producto"];

    $nuevo_id = $_POST["nuevo_id"];
    $nuevo_nombre = $_POST["nuevo_nombre"];
    $nuevo_descripcion = $_POST["nuevo_descripcion"];
    $nuevo_precio = $_POST["nuevo_precio"];
    $nueva_fecha_publicacion = $_POST["nueva_fecha_publicacion"];
    $nuevo_stock = $_POST["nuevo_stock"];

    $consulta = $conexion->prepare("UPDATE libro 
                                    SET id_Producto = :nuevo_id,
                                        Nombre = :nuevo_nombre, 
                                        Sinopsis = :nuevo_descripcion, 
                                        Precio = :nuevo_precio, 
                                        FechaPublicacion = :nueva_fecha_publicacion,
                                        Stock = :nuevo_stock
                                    WHERE id_Producto = :id_producto");

    $consulta->execute([
        ':nuevo_id' => $nuevo_id,
        ':nuevo_nombre' => $nuevo_nombre,
        ':nuevo_descripcion' => $nuevo_descripcion,
        ':nuevo_precio' => $nuevo_precio,
        ':nueva_fecha_publicacion' => $nueva_fecha_publicacion,
        ':nuevo_stock' => $nuevo_stock,
        ':id_producto' => $id_producto
    ]);

    header("Location: ../Presentador/formulario_editarP.php");
    exit();
} elseif (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    $consulta = $conexion->prepare("SELECT * FROM libro WHERE id_Producto = :id_producto");
    $consulta->execute([':id_producto' => $id_producto]);
    $producto = $consulta->fetch(PDO::FETCH_OBJ);
} else {
    header("Location: ../Presentador/formulario_editarP.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<?php include("../Datos/head.php"); ?>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Actualizar Datos de Producto</h2>

        <form action="../Dominio/editarP.php" method="post">
            <input type="hidden" name="id_producto" value="<?= $producto->id_Producto ?>">

            <div class="form-group">
                <label for="nuevo_id">ID Producto:</label>
                <input type="text" name="nuevo_id" class="form-control" value="<?= $producto->id_Producto ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_nombre">Nombre:</label>
                <input type="text" name="nuevo_nombre" class="form-control" value="<?= $producto->Nombre ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_descripcion">Descripción:</label>
                <input type="text" name="nuevo_descripcion" class="form-control" value="<?= $producto->Sinopsis ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_precio">Precio:</label>
                <input type="text" name="nuevo_precio" class="form-control" value="<?= $producto->Precio ?>" required>
            </div>

            <div class="form-group">
                <label for="nueva_fecha_publicacion">Fecha de Publicación:</label>
                <input type="date" name="nueva_fecha_publicacion" class="form-control" value="<?= $producto->FechaPublicacion ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_stock">Stock:</label>
                <input type="text" name="nuevo_stock" class="form-control" value="<?= $producto->Stock ?>" required>
            </div>

            <div class="text-center mt-3 mb-4">
                <button type="submit" class="btn btn-celeste btn-lg mr-2">Actualizar</button>
                <a href="../Presentador/formulario_editarP.php" class="btn btn-celeste btn-lg mr-2">Regresar</a>
            </div>
            
        </form>
    </div>
</body>
</html>
