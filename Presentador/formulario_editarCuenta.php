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

$id_cliente_actual = $_SESSION['cliente']['id_Cliente'];

$consulta_cliente = $conexion->prepare("SELECT * FROM cliente WHERE id_Cliente = :id_cliente");
$consulta_cliente->execute([':id_cliente' => $id_cliente_actual]);
$cliente = $consulta_cliente->fetch(PDO::FETCH_ASSOC);

$consulta_metodos_pago = $conexion->query("SELECT id_metPago, Descripcion FROM metodopago");
$metodos_pago = $consulta_metodos_pago->fetchAll(PDO::FETCH_ASSOC);

$consulta_pref_envio = $conexion->query("SELECT id_prefEnvio, Descripcion FROM prefenvio");
$pref_envio = $consulta_pref_envio->fetchAll(PDO::FETCH_ASSOC);

$consulta_mod_compra = $conexion->query("SELECT id_modCompra, Descripcion FROM modcompra");
$mod_compra = $consulta_mod_compra->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_metPago = $_POST["id_metPago"];
    $id_prefEnvio = $_POST["id_prefEnvio"];
    $id_modCompra = $_POST["id_modCompra"];

    try {
        $consulta_update = $conexion->prepare("UPDATE cliente SET id_metPago = :id_metPago, id_prefEnvio = :id_prefEnvio, id_modCompra = :id_modCompra WHERE id_Cliente = :id_cliente");
        $consulta_update->execute([':id_metPago' => $id_metPago, ':id_prefEnvio' => $id_prefEnvio, ':id_modCompra' => $id_modCompra, ':id_cliente' => $id_cliente_actual]);

        $_SESSION['mensaje'] = "Perfil actualizado exitosamente.";
        $_SESSION['mensaje_tipo'] = "success";

        header("Location: ../Presentador/formulario_editar.php");
        exit();
    } catch (Exception $error) {
        $_SESSION['mensaje'] = "Error al actualizar el perfil. Inténtalo de nuevo más tarde. Detalles: " . $error->getMessage();
        $_SESSION['mensaje_tipo'] = "danger";
    }
}
?>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Editar Perfil</h2>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert <?php echo strpos($_SESSION['mensaje'], 'Error') === false ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <form action="../Dominio/editar.php" method="post">

            <div class="form-group">
                <label for="id_metPago">Método de Pago:</label>
                <select name="id_metPago" class="form-control" required>
                    <?php foreach ($metodos_pago as $metodo): ?>
                        <option value="<?php echo $metodo['id_metPago']; ?>" <?php echo ($cliente['id_metPago'] == $metodo['id_metPago']) ? 'selected' : ''; ?>>
                            <?php echo $metodo['Descripcion']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="id_prefEnvio">Preferencia de Envío:</label>
                <select name="id_prefEnvio" class="form-control" required>
                    <?php foreach ($pref_envio as $pref): ?>
                        <option value="<?php echo $pref['id_prefEnvio']; ?>" <?php echo ($cliente['id_prefEnvio'] == $pref['id_prefEnvio']) ? 'selected' : ''; ?>>
                            <?php echo $pref['Descripcion']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="id_modCompra">Modalidad de Compra:</label>
                <select name="id_modCompra" class="form-control" required>
                    <?php foreach ($mod_compra as $mod): ?>
                        <option value="<?php echo $mod['id_modCompra']; ?>" <?php echo ($cliente['id_modCompra'] == $mod['id_modCompra']) ? 'selected' : ''; ?>>
                            <?php echo $mod['Descripcion']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-celeste">Guardar Cambios</button>
            </div>
        </form>
    </div>
    <?php include("../Datos/footer.php"); ?>
</body>
</html>
