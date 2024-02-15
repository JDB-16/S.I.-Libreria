<?php

include("../Datos/head.php");
include("../Datos/navbar.php");
include("../Datos/conexion.php");
// Consulta SQL para obtener el historial de ventas
$consulta_ventas = $conexion->query("SELECT * FROM venta ORDER BY Fecha DESC");
$ventas = $consulta_ventas->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas</title>

</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Historial de Ventas</h2>


        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Fecha</th>
                    <th>ID Cliente</th>
                    <th>Subtotal</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?= $venta->id_Venta ?></td>
                        <td><?= $venta->Fecha ?></td>
                        <td><?= $venta->id_Cliente ?></td>
                        <td>$<?= number_format($venta->Subtotal, 2) ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
