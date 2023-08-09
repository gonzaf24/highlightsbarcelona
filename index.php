<?php require "./inc/session_start.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include "./inc/head.php"; ?>
    </head>
   

    <body>
    <?php
        // Definir las páginas públicas
        $paginas_publicas = [
            'home',
            'mobility',
            'neighborhoods',
            'beaches',
            'tourist_attractions',
            'nightlife',
            'terraces',
            'tapas',
            'expensive_places',
            'food',
            'local_life',
            'neighborhoods_festivals',
            'techno_lovers'
        ];

        // Comprobar si la página solicitada es pública
        $es_publica = isset($_GET['vista']) && in_array($_GET['vista'], $paginas_publicas);
    ?>

    <?php include "./inc/navbar.php"; ?>

    <div id="content-container">
        <?php
            if (is_file("./vistas/" . $_GET['vista'] . ".php") && $_GET['vista'] != "admin_login" && $_GET['vista'] != "404") {
                // Si no es una página pública y no se ha iniciado sesión, redirigir al cierre de sesión
                if (!$es_publica && ((!isset($_SESSION['id']) || $_SESSION['id'] == "") || (!isset($_SESSION['user']) || $_SESSION['user'] == ""))) {
                    include "./vistas/admin_logout.php";
                    exit();
                }

                // Si no es una página pública, incluir la barra de navegación
                if (!$es_publica) {
                    include "./inc/admin_navbar.php";
                }

                // Incluir la vista
                include "./vistas/" . $_GET['vista'] . ".php";

                include "./inc/script.php";
            } else {
                if ($_GET['vista'] == "admin_login") {
                    include "./vistas/admin_login.php";
                } else {
                    include "./vistas/404.php";
                }
            }
        ?>
    </div>

    <?php include "./inc/footer.php"; ?>
    </body>
</html>