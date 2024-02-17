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

// Consulta para obtener las opciones de métodos de pago
$consulta_metodos_pago = $conexion->query("SELECT id_metPago, Descripcion FROM metodopago");
$metodos_pago = $consulta_metodos_pago->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener las opciones de preferencias de envío
$consulta_pref_envio = $conexion->query("SELECT id_prefEnvio, Descripcion FROM prefenvio");
$pref_envio = $consulta_pref_envio->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener las opciones de modalidades de compra
$consulta_mod_compra = $conexion->query("SELECT id_modCompra, Descripcion FROM modcompra");
$mod_compra = $consulta_mod_compra->fetchAll(PDO::FETCH_ASSOC);
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

        <form action="../Dominio/crear.php" method="post">
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

                    <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" name="apellidos" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="localidad">Localidad:</label>
                        <input type="text" name="localidad" class="form-control" placeholder="" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pais">País:</label>
                        <input type="text" name="pais" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" class="form-control" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="id_sexo">ID Sexo:</label>
                        <input type="text" name="id_sexo" class="form-control" placeholder="S01" required>
                    </div>

                    <div class="form-group">
                        <label for="id_metPago">Método de Pago:</label>
                        <select name="id_metPago" class="form-control" required>
                            <?php foreach ($metodos_pago as $metodo): ?>
                                <option value="<?php echo $metodo['id_metPago']; ?>"><?php echo $metodo['Descripcion']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_prefEnvio">Preferencia de Envío:</label>
                        <select name="id_prefEnvio" class="form-control" required>
                            <?php foreach ($pref_envio as $pref): ?>
                                <option value="<?php echo $pref['id_prefEnvio']; ?>"><?php echo $pref['Descripcion']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_modCompra">Modalidad de Compra:</label>
                        <select name="id_modCompra" class="form-control" required>
                            <?php foreach ($mod_compra as $mod): ?>
                                <option value="<?php echo $mod['id_modCompra']; ?>"><?php echo $mod['Descripcion']; ?></option>
                            <?php endforeach; ?>
                        </select>
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
