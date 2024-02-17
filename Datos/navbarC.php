
<nav class="navbar navbar-expand-lg navbar-light color_fondo bg-celeste">
    <div class="container-fluid">
        <a class="navbar-brand mr-auto" href="../Presentador/formulario_login.php">
            <img src="../imagenes/Logo.png" alt="Logo" style="width: 200px; height: auto;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <!--<li class="nav-item">
                    <a class="nav-link" href="formulario_login.php">Login</a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="../Presentador/formulario_editarCuenta.php">Editar Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Presentador/formulario_productos.php">Comprar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Presentador/ver_carrito.php">Carrito</a>
                </li>
            </ul>
        </div>
        <form method="post" class="ml-auto" action="../Dominio/salir.php">
            <button class="nav-link text-dark" type="submit">salir</button>
        </form>
    </div>
</nav>