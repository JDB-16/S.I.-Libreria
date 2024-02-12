<?php
session_start();
if (!isset($_SESSION['medico'])) {
    header('Location: f_session.php');
    exit();
}
include("head.php");
include("navbar.php");
?>


<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Registro de Producto</h2>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert <?php echo strpos($_SESSION['mensaje'], 'Error') === false ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <form action="crearP.php" method="post">
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
                        <label for="descripcion">Descripción:</label>
                        <input type="text" name="descripcion" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="text" name="precio" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="id_tipo">ID Tipo:</label>
                        <input type="text" name="id_tipo" class="form-control" placeholder="T01" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="almacenamiento">Almacenamiento:</label>
                        <input type="text" name="almacenamiento" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="lectura">Lectura:</label>
                        <input type="text" name="lectura" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="escritura">Escritura:</label>
                        <input type="text" name="escritura" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="vida_operativa">Vida Operativa:</label>
                        <input type="text" name="vida_operativa" class="form-control" placeholder="" required>
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
    <?php include("footer.php"); ?>
</body>
</html>
