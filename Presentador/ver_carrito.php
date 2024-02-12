<?php
session_start();


if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    include("head.php");
    if (!isset($_SESSION['medico'])) {
        include("navbarC.php");
    }
    
    if (!isset($_SESSION['cliente'])) {
        include("navbar.php");
    }
    include("conexion.php");


    $cantidad_unidades = array_count_values($_SESSION['carrito']);


    $placeholders = implode(',', array_fill(0, count($_SESSION['carrito']), '?'));
    $consulta = $conexion->prepare("SELECT id_Producto, Nombre, Precio, Stock FROM producto WHERE id_Producto IN ($placeholders)");


    $consulta->execute(array_values($_SESSION['carrito']));
    $productos_carrito = $consulta->fetchAll(PDO::FETCH_OBJ);
?>
    <body class="bg-light">
        <div class="container mt-5">
            <h2 class="text-center mb-4">Productos en el Carrito</h2>


            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio $</th>
                        <th>Stock</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos_carrito as $producto): ?>
                        <tr>
                            <td><?= $producto->id_Producto ?></td>
                            <td><?= $producto->Nombre ?></td>
                            <td><?= $producto->Precio ?></td>
                            <td><?= $producto->Stock ?></td>
                            <td><?= $cantidad_unidades[$producto->id_Producto] ?></td>
                            <td>

                                <form action="eliminar_del_carrito.php" method="post">
                                    <input type="hidden" name="id_producto" value="<?= $producto->id_Producto ?>">
                                    <button type="submit" class="btn btn-danger">Eliminar del Carrito</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <form action="completar_venta.php" method="post" class="mt-3 text-center">
                <button type="submit" class="btn btn-success">Completar Venta</button>
            </form>
        </div>

        <?php include("footer.php"); ?>
    </body>
    </html>
<?php
} else {

    header("Location: formulario_productos.php");
    exit();
}
?>
