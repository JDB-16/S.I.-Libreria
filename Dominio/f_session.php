<?php
session_start();
include("head.php");
?>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">No estas logeado como médico</h2>
        
        <!--   Prueba   -->
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert <?php echo strpos($_SESSION['mensaje'], 'Error') === false ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']);  ?>
        <?php endif; ?>

         <!--<form action="" method="post">
            <div class="text-center mt-3">
                <a href="formulario_login.php" class="btn btn-celeste">Ir al Login</a>
            </div>
        </form>-->
        <form method="post" class="text-center mt-3" action="salir.php">
            <button class="btn btn-celeste" type="submit">Ir al login</button>
        </form>
    </div>
</body>
</html>
