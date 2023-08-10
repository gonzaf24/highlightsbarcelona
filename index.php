<?php require "./inc/session_start.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include "./inc/head.php"; ?>
    </head>
   

    <body>
        <?php include "./inc/navbar.php"; ?>
        <?php
            // Definir la página predeterminada
            if (!isset($_GET['vista']) || $_GET['vista'] == "") {
                $_GET['vista'] = "home"; // La página de inicio será la vista predeterminada
            }

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
            $es_publica = in_array($_GET['vista'], $paginas_publicas);

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
        <?php include "./inc/footer.php"; ?>
    </body>

    <script src="https://kit.fontawesome.com/a11b4444d7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
        effect: "cube",
        grabCursor: true,
        loop: true,
        cubeEffect: {
            shadow: true,
            slideShadows: true,
            shadowOffset: 20,
            shadowScale: 0.94,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        });
    </script>
</html>