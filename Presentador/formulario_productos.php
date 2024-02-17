<?php
session_start();
include("../Datos/head.php");
if (!isset($_SESSION['medico'])) {
    include("../Datos/navbarC.php");
}

if (!isset($_SESSION['cliente'])) {
    include("../Datos/navbar.php");
}
include("../Datos/conexion.php");

$consulta_productos = $conexion->query("SELECT id_Producto, Nombre, Autor, Precio, Stock FROM libro");
$productos = $consulta_productos->fetchAll(PDO::FETCH_OBJ);
?>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Lista de Productos</h2>

        <table class="table table-bordered text-center mb-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Autor</th>
                    <th>Precio $</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto->id_Producto ?></td>
                        <td><?= $producto->Nombre ?></td>
                        <td><?= $producto->Autor ?></td>
                        <td><?= $producto->Precio ?></td>
                        <td><?= $producto->Stock ?></td>
                        <td>
                            <?php if ($producto->Stock > 0): ?>
                                <form action="../Dominio/añadir_al_carrito.php" method="post">
                                    <input type="hidden" name="id_producto" value="<?= $producto->id_Producto ?>">
                                    <button type="submit" class="btn btn-success">Agregar al Carrito</button>
                                </form>
                            <?php else: ?>
                                <span class="text-danger">Sin Stock</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include("../Datos/footer.php"); ?>
</body>
</html>
