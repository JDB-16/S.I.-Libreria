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
        <h2 class="text-center mb-4">Registro de Usuario</h2>


        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert <?php echo strpos($_SESSION['mensaje'], 'Error') === false ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <form action="crear.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_cliente">ID Cliente:</label>
                        <input type="text" name="id_cliente" class="form-control" placeholder="C019" required>
                    </div>

                    <div class="form-group">
                        <label for="dni">DNI:</label>
                        <input type="text" name="dni" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" name="contrasena" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <input type="text" name="nombres" class="form-control" placeholder="" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" name="apellidos" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Direccion:</label>
                        <input type="text" name="direccion" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="id_sexo">Id_Sexo:</label>
                        <input type="text" name="id_sexo" class="form-control" placeholder="S01" required>
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
