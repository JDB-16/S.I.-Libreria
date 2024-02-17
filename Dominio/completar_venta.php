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
                $consulta_producto = $conexion->prepare("SELECT id_Producto, Nombre, Precio, Stock FROM libro WHERE id_Producto = ?");
                $consulta_producto->execute([$id_Producto]);
                $producto = $consulta_producto->fetch(PDO::FETCH_OBJ);
                $subtotal += $producto->Precio;
                $productos[] = $producto;
        
                // Verificar si hay suficiente stock para completar la venta
                if ($producto->Stock > 0) {
                    // Actualizar el stock en la base de datos
                    $nuevo_stock = $producto->Stock - 1;
                    $actualizar_stock = $conexion->prepare("UPDATE libro SET Stock = ? WHERE id_Producto = ?");
                    $actualizar_stock->execute([$nuevo_stock, $id_Producto]);
                } else {
                    // Si no hay suficiente stock, mostrar un mensaje y salir
                    throw new Exception("No hay suficiente stock para completar la venta.");
                }
            }

            $consulta_cliente = $conexion->prepare("SELECT id_metPago, id_prefEnvio, id_modCompra FROM cliente WHERE id_Cliente = ?");
            $consulta_cliente->execute([$id_Cliente]);
            $cliente = $consulta_cliente->fetch(PDO::FETCH_OBJ);
            
            $id_metPago = $cliente->id_metPago;
            $id_prefEnvio = $cliente->id_prefEnvio;
            $id_modCompra = $cliente->id_modCompra;
            
            $consulta_id_venta = $conexion->query("SELECT MAX(CAST(SUBSTRING(id_Venta, 2) AS UNSIGNED)) + 1 AS next_id FROM venta");
            $next_id = $consulta_id_venta->fetchColumn();

            if (!$next_id) {
                $next_id = 1;
            }

            $id_Venta = 'V' . str_pad($next_id, 3, '0', STR_PAD_LEFT);

            $consulta_venta = $conexion->prepare("INSERT INTO venta (id_Venta, Fecha, id_Producto, Subtotal, id_Cliente, id_metPago, id_prefEnvio, id_modCompra) VALUES (?, NOW(), ?, ?, ?, ?, ?, ?)");

            $consulta_venta->execute([$id_Venta, $id_Producto, $subtotal, $id_Cliente, $id_metPago, $id_prefEnvio, $id_modCompra]);

            // Consulta para obtener la descripción del método de pago
            $consulta_metPago = $conexion->prepare("SELECT Descripcion FROM metodopago WHERE id_metPago = ?");
            $consulta_metPago->execute([$id_metPago]);
            $metodo_pago = $consulta_metPago->fetchColumn();

            // Consulta para obtener la descripción de la preferencia de envío
            $consulta_prefEnvio = $conexion->prepare("SELECT Descripcion FROM prefenvio WHERE id_prefEnvio = ?");
            $consulta_prefEnvio->execute([$id_prefEnvio]);
            $pref_envio = $consulta_prefEnvio->fetchColumn();

            // Consulta para obtener la descripción de la modalidad de compra
            $consulta_modCompra = $conexion->prepare("SELECT Descripcion FROM modcompra WHERE id_modCompra = ?");
            $consulta_modCompra->execute([$id_modCompra]);
            $mod_compra = $consulta_modCompra->fetchColumn();

            unset($_SESSION['carrito']);

            echo '<body class="bg-light">';
            echo '<div class="container mt-5">';
            echo '<h2 class="text-center mb-4">Venta Completada</h2>';
            echo '<p class="lead">¡La venta se ha completado con éxito!</p>';
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Resumen de la Venta</h5>';
            echo '<p class="card-text"><b>ID de Venta:</b> ' . $id_Venta . '</p>';
            echo '<p class="card-text"><b>Fecha:</b> ' . date('Y-m-d H:i:s') . '</p>';
            echo '<p class="card-text"><b>ID del Cliente:</b> ' . $id_Cliente . '</p>';
            echo '<p class="card-text"><b>Método de Pago:</b> ' . $metodo_pago . '</p>';
            echo '<p class="card-text"><b>Preferencia de Envío:</b> ' . $pref_envio . '</p>';
            echo '<p class="card-text"><b>Modalidad de Compra:</b> ' . $mod_compra . '</p>';
            
            echo '<p class="card-text"><b>Productos Comprados:</b></p>';
            echo '<ul class="list-group">';
            foreach ($productos as $producto) {
                echo '<li class="list-group-item">' . $producto->Nombre . ' - Precio: $' . number_format($producto->Precio, 2) . '</li>';
            }
            echo '</ul>';
            
            echo '<p class="card-text"><b>Subtotal:</b> $' . number_format($subtotal, 2) . '</p>';
            echo '<p class="card-text">Gracias por realizar tu compra. Para volver a la página de inicio, haz clic <a href="../Presentador/formulario_productos.php">aquí</a>.</p>';
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