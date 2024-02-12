<?php
include("head.php");
include("navbar.php");
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST["id_producto"];

    $nuevo_id = $_POST["nuevo_id"];
    $nuevo_nombre = $_POST["nuevo_nombre"];
    $nuevo_descripcion = $_POST["nuevo_descripcion"];
    $nuevo_precio = $_POST["nuevo_precio"];
    $nueva_tipo = $_POST["nueva_tipo"];
    $nuevo_almacenamiento = $_POST["nuevo_almacenamiento"];
    $nuevo_lectura = $_POST["nuevo_lectura"];
    $nuevo_escritura = $_POST["nuevo_escritura"];
    $nuevo_vida = $_POST["nuevo_vida"];
    $nuevo_stock = $_POST["nuevo_stock"];

    $consulta = $conexion->prepare("UPDATE producto 
                                    SET id_Producto = :nuevo_id,
                                        Nombre = :nuevo_nombre, 
                                        Descripcion = :nuevo_descripcion, 
                                        Precio = :nuevo_precio, 
                                        id_Tipo = :nueva_tipo, 
                                        Almacenamiento = :nuevo_almacenamiento, 
                                        Lectura = :nuevo_lectura, 
                                        Escritura = :nuevo_escritura, 
                                        Vida_Operativa = :nuevo_vida,
                                        Stock = :nuevo_stock
                                    WHERE id_Producto = :id_producto");

    $consulta->execute([
        ':nuevo_id' => $nuevo_id,
        ':nuevo_nombre' => $nuevo_nombre,
        ':nuevo_descripcion' => $nuevo_descripcion,
        ':nuevo_precio' => $nuevo_precio,
        ':nueva_tipo' => $nueva_tipo,
        ':nuevo_almacenamiento' => $nuevo_almacenamiento,
        ':nuevo_lectura' => $nuevo_lectura,
        ':nuevo_escritura' => $nuevo_escritura,
        ':nuevo_vida' => $nuevo_vida,
        ':nuevo_stock' => $nuevo_stock,
        ':id_producto' => $id_producto
    ]);

        header("Location: formulario_editarP.php");
    exit();
} elseif (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    $consulta = $conexion->prepare("SELECT * FROM producto WHERE id_Producto = :id_producto");
    $consulta->execute([':id_producto' => $id_producto]);
    $producto = $consulta->fetch(PDO::FETCH_OBJ);
} else {
    header("Location: formulario_editarP.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<?php include("head.php"); ?>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Actualizar Datos de Producto</h2>

        <form action="editarP.php" method="post">
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
                <input type="text" name="nuevo_descripcion" class="form-control" value="<?= $producto->Descripcion ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_precio">Precio:</label>
                <input type="text" name="nuevo_precio" class="form-control" value="<?= $producto->Precio ?>" required>
            </div>

            <div class="form-group">
                <label for="nueva_tipo">ID Tipo:</label>
                <input type="text" name="nueva_tipo" class="form-control" value="<?= $producto->id_Tipo ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_almacenamiento">Almacenamiento:</label>
                <input type="text" name="nuevo_almacenamiento" class="form-control" value="<?= $producto->Almacenamiento ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_lectura">Lectura:</label>
                <input type="text" name="nuevo_lectura" class="form-control" value="<?= $producto->Lectura ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_escritura">Escritura:</label>
                <input type="text" name="nuevo_escritura" class="form-control" value="<?= $producto->Escritura ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_vida">Vida Operativa:</label>
                <input type="text" name="nuevo_vida" class="form-control" value="<?= $producto->Vida_Operativa ?>" required>
            </div>

            <div class="form-group">
                <label for="nuevo_stock">Stock:</label>
                <input type="text" name="nuevo_stock" class="form-control" value="<?= $producto->Stock ?>" required>
            </div>

            <div class="text-center mt-3 mb-4">
                <button type="submit" class="btn btn-celeste btn-lg mr-2">Actualizar</button>
                <a href="formulario_editarP.php" class="btn btn-celeste btn-lg mr-2">Regresar</a>
            </div>
            
        </form>
    </div>
</body>
</html>
