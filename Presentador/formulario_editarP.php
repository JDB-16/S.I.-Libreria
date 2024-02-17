<?php
session_start();
if (!isset($_SESSION['medico'])) {
    header('Location: ../Dominio/f_session.php');
    exit();
}
include("../Datos/head.php");
include("../Datos/navbar.php");
include("../Datos/conexion.php");

// Obtener la lista de productos ordenada por id_Producto de menor a mayor
$consulta = $conexion->query("SELECT id_Producto, Nombre, Sinopsis, Autor, Precio FROM libro ORDER BY id_Producto ASC");
$productos = $consulta->fetchAll(PDO::FETCH_OBJ);
?>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Consulta de Productos</h2>

        <!-- Formulario de Consulta -->
        <form action="" method="post">
            <div class="form-group">
                <label for="consulta">Ingrese cualquiera de los siguientes datos: ID, Nombre, Precio:</label>
                <input type="text" name="consulta" class="form-control" placeholder="Ejem: P001 o Nombre del Producto" required>
            </div>
            <div class="text-center mt-3 mb-4">
                <button type="submit" class="btn btn-celeste btn-lg">Consultar</button>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include("../Datos/conexion.php");

            $consulta_parametro = $_POST["consulta"];

            $consulta = $conexion->prepare("SELECT * FROM libro 
                                            WHERE id_Producto = :consulta 
                                               OR Nombre LIKE :parametro 
                                               OR Precio = :consulta");
            $consulta->execute([':consulta' => $consulta_parametro, ':parametro' => "%$consulta_parametro%"]);
            $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);

            // Mostrar resultados
            if ($consulta->rowCount() > 0) {
                echo "<h3 class='mt-4'>Resultados:</h3>";

                foreach ($resultado as $producto) {
                    echo "<div class='card mt-3'>";
                    echo "<div class='card-body'>";
                    echo "<p class='card-text'><strong>ID:</strong> " . $producto->id_Producto . "</p>";
                    echo "<p class='card-text'><strong>Nombre:</strong> " . $producto->Nombre . "</p>";
                    echo "<p class='card-text'><strong>Sinopsis:</strong> " . $producto->Sinopsis . "</p>";
                    echo "<p class='card-text'><strong>Autor:</strong> " . $producto->Autor . "</p>";
                    echo "<p class='card-text'><strong>Precio:</strong> $" . $producto->Precio . "</p>";
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
        <h2 class="text-center mb-4">Actualizar y Eliminar Producto</h2>

        <!-- Mostrar la lista de productos con botones de edición y eliminación -->
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Sinopsis</th>
                    <th>Autor</th>
                    <th>Precio$</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto->id_Producto ?></td>
                        <td><?= $producto->Nombre ?></td>
                        <td><?= $producto->Sinopsis ?></td>
                        <td><?= $producto->Autor ?></td>
                        <td><?= $producto->Precio ?></td>
                        <td>
                            <a href="../Dominio/editarP.php?id=<?= $producto->id_Producto ?>" class="btn btn-primary">Editar</a>
                            <a href="../Dominio/eliminarP.php?id=<?= $producto->id_Producto ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include("../Datos/footer.php"); ?>
</body>
</html>
