<?php
include("head.php");


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['cliente'])) {
    header('Location: formulario_productos.php');
    exit();
}


if (isset($_SESSION['medico'])) {
    header('Location: formulario_crear.php');
    exit();
}


if (!isset($_COOKIE['intentos'])) {
    setcookie('intentos', 0, time() + 30, '/');
}
?>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <h1 class="mb-5 text-center bg-celeste text-white p-2 rounded">Login</h1>

                    <form action="login.php" method="post">
                        <div class="mb-4">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="mb-4">
                            <label for="contrasena" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                        </div>

                        <div class="text-center mb-4">
                            <?php
                            if (isset($_COOKIE['intentos']) && $_COOKIE['intentos'] >= 2) {
                                echo "<button type='submit' class='btn btn-celeste btn-lg' disabled>Iniciar sesión</button>";
                            } elseif (isset($_COOKIE['intentos'])) {
                                echo "<button type='submit' class='btn btn-celeste btn-lg'>Iniciar sesión</button>";
                            } else {
                                echo "<button type='submit' class='btn btn-celeste btn-lg'>Iniciar sesión</button>";
                            }
                            ?>
                            <button type="reset" class="btn btn-celeste btn-lg">Limpiar</button>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="mb-0">¿Aún no tienes cuenta?</p>
                        <a href="formulario_crear_pa.php" class="btn btn-link">Regístrate como Paciente</a>
                    </div>

                    <div class="mt-4">
                        <?php
                        if (isset($mensaje)) {
                            echo '<div class="alert alert-' . $mensaje_tipo . ' alert-dismissible fade show" role="alert">
                                    ' . $mensaje . '
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center mt-2">
        <p>Rol: Administrador - Cliente</p>
        <p>Administrador: Joarri - 1234</p>
        <p>Cliente: 71893568 - 1234</p>
    </div>

</body>
</html>
