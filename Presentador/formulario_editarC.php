<?php
session_start();
if (!isset($_SESSION['medico'])) {
    header('Location: ../Dominio/f_session.php');
    exit();
}
include("../Datos/head.php");
include("../Datos/navbar.php");
include("../Datos/conexion.php");


$consulta = $conexion->query("SELECT c.id_Cliente, c.DNI, c.Nombres, c.Apellidos, mp.Descripcion AS MetodoPago, pe.Descripcion AS PrefEnvio, mc.Descripcion AS modCompra
                                FROM cliente c 
                                LEFT JOIN metodopago mp ON c.id_metPago = mp.id_metPago 
                                LEFT JOIN prefenvio pe ON c.id_prefEnvio = pe.id_prefEnvio
                                LEFT JOIN modcompra mc ON c.id_modCompra =mc.id_modCompra 
                                ORDER BY c.id_Cliente ASC");
$clientes = $consulta->fetchAll(PDO::FETCH_OBJ);
?>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Consulta de Clientes</h2>


        <form action="" method="post">
            <div class="form-group">
                <label for="consulta">Ingrese cualquiera de los siguientes datos: ID, DNI, Correo, Username, Nombre, Apellidos, ID Sexo o Celular:</label>
                <input type="text" name="consulta" class="form-control" placeholder="Ejem: C001 o S01" onfocus="if (this.value == 'Ejem: C001 o S01') {this.value = '';}" required>
            </div>
            <div class="text-center mt-3 mb-4">
                <button type="submit" class="btn btn-celeste btn-lg">Consultar</button>
            </div>
        </form>

        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include("../Datos/conexion.php");

            $consulta_parametro = $_POST["consulta"];

            $consulta = $conexion->prepare("SELECT * FROM cliente 
                                            WHERE id_Cliente = :consulta 
                                               OR DNI = :consulta 
                                               OR Nombres = :consulta 
                                               OR Apellidos = :consulta 
                                               OR Direccion LIKE :parametro 
                                               OR id_Sexo LIKE :parametro");
        $consulta->execute([':consulta' => $consulta_parametro, ':parametro' => "%$consulta_parametro%"]);
        $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);


        if ($consulta->rowCount() > 0) {
            echo "<h3 class='mt-4'>Resultados:</h3>";

            foreach ($resultado as $cliente) {
                echo "<div class='card mt-3'>";
                echo "<div class='card-body'>";
                echo "<p class='card-text'>ID: " . $cliente->id_Cliente . "</p>";
                echo "<p class='card-text'>DNI: " . $cliente->DNI . "</p>";

                echo "<p class='card-text'>Nombre: " . $cliente->Nombres . "</p>";
                echo "<p class='card-text'>Apellidos: " . $cliente->Apellidos . "</p>";
                echo "<p class='card-text'>Direccion: " . $cliente->Direccion . "</p>";
                echo "<p class='card-text'>id_Sexo : " . $cliente->id_Sexo  . "</p>";
                echo "<p class='card-text'>id_metPago : " . $cliente->id_metPago  . "</p>";
                echo "<p class='card-text'>id_prefEnvio : " . $cliente->id_prefEnvio  . "</p>";
                echo "</div>";
                echo "</div>";
                }
            } else {
                echo "<p class='mt-4'>No se encontraron resultados.</p>";
            }
        }
        ?>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Actualizar y Eliminar Clientes</h2>


        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Método de Pago</th>
                    <th>Preferencia de Envío</th>
                    <th>Modalidad de compra</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= $cliente->id_Cliente ?></td>
                        <td><?= $cliente->DNI ?></td>
                        <td><?= $cliente->Nombres ?></td>
                        <td><?= $cliente->Apellidos ?></td>
                        <td><?= $cliente->MetodoPago ?></td>
                        <td><?= $cliente->PrefEnvio ?></td>
                        <td><?= $cliente->modCompra ?></td>
                        <td>
                            <a href="../Dominio/editarC.php?id=<?= $cliente->id_Cliente ?>" class="btn btn-primary">Editar</a>
                            <a href="../Dominio/eliminarC.php?id=<?= $cliente->id_Cliente ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include("../Datos/footer.php"); ?>
</body>
</html>