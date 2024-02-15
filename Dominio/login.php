<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../Datos/conexion.php");

if (!isset($_COOKIE['intentos'])) {
    setcookie('intentos', 0, time() + 30, '/');
}

function manejarIntentos($maxIntentos, $tiempoBloqueo) {
    $intentos = isset($_COOKIE['intentos']) ? $_COOKIE['intentos'] : 0;
    $intentos++;

    if ($intentos >= $maxIntentos) {
        echo '<div class="alert alert-danger" role="alert" style="background-color: #dc3545; color: white;">Has alcanzado el número máximo de intentos. La cuenta estará bloqueada por ' . $tiempoBloqueo . ' segundos. Espere...</div>';
        include("../Presentador/formulario_login.php");
        setcookie('intentos', $intentos, time() + $tiempoBloqueo, '/');

        echo '<meta http-equiv="refresh" content="' . $tiempoBloqueo . ';url=../Presentador/formulario_login.php">';
        exit();
    }

    setcookie('intentos', $intentos, time() + 30, '/');
    return $intentos;
}

if ($_POST) {
    $username = $_POST["username"];
    $contrasena = $_POST["contrasena"];

    try {
        $consulta_cliente = $conexion->prepare("SELECT * FROM cliente WHERE DNI = :username");
        $consulta_cliente->bindParam(':username', $username);
        $consulta_cliente->execute();

        $cliente = $consulta_cliente->fetch(PDO::FETCH_ASSOC);

         $consulta_medico = $conexion->prepare("SELECT * FROM administrador WHERE Username = :username");
        $consulta_medico->bindParam(':username', $username);
        $consulta_medico->execute();

        $medico = $consulta_medico->fetch(PDO::FETCH_ASSOC);

        if ($cliente && isset($cliente['Contraseña']) && $contrasena === $cliente['Contraseña']) {
            session_start();
            $_SESSION['intentos'] = 0;
            $_COOKIE['intentos'] = 0;
            $_SESSION['cliente'] = $cliente;
            header("Location: ../Presentador/formulario_productos.php");
            exit();
        } elseif ($medico && isset($medico['Contraseña']) && $contrasena === $medico['Contraseña']) {
            session_start();
            $_SESSION['intentos'] = 0;
            $_COOKIE['intentos'] = 0;
            $_SESSION['medico'] = $medico;
            header("Location: ../Presentador/formulario_crear.php");
            exit();
        } else {
            $intentos = manejarIntentos(3, 30);

            echo '<div class="alert alert-danger" role="alert">Credenciales incorrectas. Intento ' . $intentos . ' de 3. Quedan ' . (3 - $intentos) . ' intentos antes del bloqueo.</div>';
            include("../Presentador/formulario_login.php");
        }

    } catch (Exception $error) {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $error->getMessage() . '</div>';
    }
}
?>
