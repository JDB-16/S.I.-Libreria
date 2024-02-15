<?php
session_start();
if (!isset($_SESSION['medico'])) {
    header('Location: ../Dominio/f_session.php');
    exit();
}
include("../Datos/head.php");
include("../Datos/navbar.php");
include("../Datos/conexion.php");

// Obtener la lista de pacientes ordenada por id_Paciente de menor a mayor
$consulta = $conexion->query("SELECT id_Producto, Nombre, Descripcion, Precio FROM producto ORDER BY id_Producto ASC");
$productos = $consulta->fetchAll(PDO::FETCH_OBJ);
?>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Consulta de Productos</h2>

        <!-- Formulario de Consulta -->
        <form action="" method="post">
            <div class="form-group">
                <label for="consulta">Ingrese cualquiera de los siguientes datos: ID, DNI, Correo, Username, Nombre, Apellidos, ID Sexo o Celular:</label>
                <input type="text" name="consulta" class="form-control" placeholder="Ejem: C001 o S01" onfocus="if (this.value == 'Ejem: P001 o S1') {this.value = '';}" required>
            </div>
            <div class="text-center mt-3 mb-4">
                <button type="submit" class="btn btn-celeste btn-lg">Consultar</button>
            </div>
        </form>

        <?php
        // Verificar si se ha enviado el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include("../Datos/conexion.php");

            $consulta_parametro = $_POST["consulta"];

            $consulta = $conexion->prepare("SELECT * FROM producto 
                                            WHERE id_Producto = :consulta 
                                               OR Nombre = :consulta 
                                               OR Precio = :consulta 
                                               OR id_Tipo LIKE :parametro
                                               OR Almacenamiento = :consulta
                                               OR Lectura = :consulta
                                               OR Escritura = :consulta
                                               OR Vida_Operativa = :consulta
                                               OR Stock = :consulta");
        $consulta->execute([':consulta' => $consulta_parametro, ':parametro' => "%$consulta_parametro%"]);
        $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);

        // Mostrar resultados
        if ($consulta->rowCount() > 0) {
            echo "<h3 class='mt-4'>Resultados:</h3>";

            foreach ($resultado as $producto) {
                echo "<div class='card mt-3'>";
                echo "<div class='card-body'>";
                echo "<p class='card-text'>ID: " . $producto->id_Producto . "</p>";
                echo "<p class='card-text'>Nombre: " . $producto->Nombre . "</p>";
                echo "<p class='card-text'>Precio: $" . $producto->Precio . "</p>";
                echo "<p class='card-text'>id_Tipo: " . $producto->id_Tipo . "</p>";
                echo "<p class='card-text'>Almacenamiento: " . $producto->Almacenamiento . "</p>";
                echo "<p class='card-text'>Lectura : " . $producto->Lectura  . "</p>";
                echo "<p class='card-text'>Escritura: " . $producto->Escritura . "</p>";
                echo "<p class='card-text'>Vida Operativa : " . $producto->Vida_Operativa . "</p>";
                echo "<p class='card-text'>Stock : " . $producto->Stock . "</p>";
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
        <h2 class="text-center mb-4">Actualizar y Eliminar Productos</h2>

        <!-- Mostrar la lista de pacientes con botones de edición y eliminación -->
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio$</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto->id_Producto ?></td>
                        <td><?= $producto->Nombre ?></td>
                        <td><?= $producto->Descripcion ?></td>
                        <td><?= $producto->Precio ?></td>
                        <td>
                            <a href="editarP.php?id=<?= $producto->id_Producto ?>" class="btn btn-primary">Editar</a>
                            <a href="eliminarP.php?id=<?= $producto->id_Producto ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include("../Datos/footer.php"); ?>
</body>
</html>
