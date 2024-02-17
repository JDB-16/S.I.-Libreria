<?php
session_start();
if (!isset($_SESSION['medico'])) {
    header('Location: ../Dominio/f_session.php');
    exit();
}
include("../Datos/head.php");
include("../Datos/navbar.php");
?>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Registro de Libros</h2>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert <?php echo strpos($_SESSION['mensaje'], 'Error') === false ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <form action="../Dominio/crearP.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_producto">ID Producto:</label>
                        <input type="text" name="id_producto" class="form-control" placeholder="P999" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="sinopsis">Sinopsis:</label>
                        <input type="text" name="sinopsis" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="autor">Autor:</label>
                        <input type="text" name="autor" class="form-control" placeholder="" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="text" name="precio" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_publicacion">Fecha de Publicación:</label>
                        <input type="date" name="fecha_publicacion" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input type="text" name="stock" class="form-control" placeholder="" required>
                    </div>
                </div>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-celeste">Registrar</button>
            </div>
        </form>
    </div>
    <?php include("../Datos/footer.php"); ?>
</body>
</html>
