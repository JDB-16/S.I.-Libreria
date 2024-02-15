<?php
session_start();

if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    include("../Datos/head.php");
    include("../Datos/navbar.php");
    include("../Datos/conexion.php");

    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_Cliente'])) {
            $id_Cliente = $_POST['id_Cliente'];

            $subtotal = 0;
            $productos = [];

            foreach ($_SESSION['carrito'] as $id_Producto) {
                $consulta_producto = $conexion->prepare("SELECT id_Producto, Nombre, Precio, Stock FROM producto WHERE id_Producto = ?");
                $consulta_producto->execute([$id_Producto]);
                $producto = $consulta_producto->fetch(PDO::FETCH_OBJ);
                $subtotal += $producto->Precio;
                $productos[] = $producto;

                if ($producto->Stock > 0) {
                    $nuevo_stock = $producto->Stock - 1;
                    $actualizar_stock = $conexion->prepare("UPDATE producto SET Stock = ? WHERE id_Producto = ?");
                    $actualizar_stock->execute([$nuevo_stock, $id_Producto]);
                } else {
                        throw new Exception("No hay suficiente stock para completar la venta.");
                }
            }

            $consulta_id_venta = $conexion->query("SELECT MAX(CAST(SUBSTRING(id_Venta, 2) AS UNSIGNED)) + 1 AS next_id FROM venta");
            $next_id = $consulta_id_venta->fetchColumn();

            if (!$next_id) {
                $next_id = 1;
            }

            $id_Venta = 'V' . str_pad($next_id, 3, '0', STR_PAD_LEFT);

            $consulta_venta = $conexion->prepare("INSERT INTO venta (id_Venta, Fecha, id_Producto, Subtotal, id_Cliente) VALUES (?, NOW(), ?, ?, ?)");

            $consulta_venta->execute([$id_Venta, $id_Producto, $subtotal, $id_Cliente]);

            unset($_SESSION['carrito']);

            echo '<body class="bg-light">';
            echo '<div class="container mt-5">';
            echo '<h2 class="text-center mb-4">Venta Completada</h2>';
            echo '<p class="lead">¡La venta se ha completado con éxito!</p>';
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Resumen de la Venta</h5>';
            echo '<p class="card-text">ID de Venta: ' . $id_Venta . '</p>';
            echo '<p class="card-text">Fecha: ' . date('Y-m-d H:i:s') . '</p>';
            echo '<p class="card-text">ID del Cliente: ' . $id_Cliente . '</p>';
            
            echo '<p class="card-text">Productos Comprados:</p>';
            echo '<ul class="list-group">';
            foreach ($productos as $producto) {
                echo '<li class="list-group-item">' . $producto->Nombre . ' - Precio: $' . number_format($producto->Precio, 2) . '</li>';
            }
            echo '</ul>';

            echo '<p class="card-text">Subtotal: $' . number_format($subtotal, 2) . '</p>';
            echo '<p class="card-text">Gracias por realizar tu compra. Para volver a la página de inicio, haz clic <a href="formulario_productos.php">aquí</a>.</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</body>';
            echo '</html>';
            
            exit();
        }


        $consulta_clientes = $conexion->query("SELECT id_Cliente, Nombres, Apellidos FROM cliente");
        $clientes = $consulta_clientes->fetchAll(PDO::FETCH_OBJ);
?>
    <body class="bg-light">
        <div class="container mt-5">
            <h2 class="text-center mb-4">Completar Venta</h2>


            <form action="" method="post">
                <div class="form-group">
                    <label for="id_Cliente">Seleccionar Cliente:</label>
                    <select name="id_Cliente" class="form-control" required>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente->id_Cliente ?>"><?= $cliente->Nombres . ' ' . $cliente->Apellidos ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="text-center mt-3 mb-4">
                    <button type="submit" class="btn btn-celeste btn-lg">Completar Venta</button>
                </div>
            </form>
        </div>
        <?php include("../Datos/footer.php"); ?>
    </body>
    </html>
<?php
    } catch (Exception $e) {
        echo '<body class="bg-light">';
        echo '<div class="container mt-5">';
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Error al completar la venta: ' . $e->getMessage();
        echo '</div>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
    }
} else {
    header("Location: ../Presentador/formulario_productos.php");
    exit();
}
?>
