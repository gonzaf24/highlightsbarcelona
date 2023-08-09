<?php
    require_once "../inc/session_start.php";
    require_once "main.php";

    $post_id = $_POST['post_id']; // Asegúrate de enviar el ID del post al que quieres agregar las fotos

    /* Directorios de imágenes */
    $img_dir='../img/post/';
    $fotos = [];

    if (isset($_FILES['post_foto']) && !empty($_FILES['post_foto']['name'][0])) {
        $total_images = count($_FILES['post_foto']['name']);

        /* Creando directorio de imágenes */
        if (!file_exists($img_dir)) {
            if (!mkdir($img_dir, 0777)) {
                echo '<div class="notification is-danger is-light">Error al crear el directorio de imágenes</div>';
                exit();
            }
        }

        /* Loop through each image */
        for ($i = 0; $i < $total_images; $i++) {
            $image_name = $_FILES['post_foto']['name'][$i];
            $image_tmp = $_FILES['post_foto']['tmp_name'][$i];
            $image_type = mime_content_type($image_tmp);

            /* Comprobando formato de las imágenes */
            if ($image_type != "image/jpeg" && $image_type != "image/png") {
                echo '<div class="notification is-danger is-light">La imagen ' . $image_name . ' tiene un formato no permitido</div>';
                exit();
            }

            /* Comprobando que la imagen no supere el peso permitido */
            if ($_FILES['post_foto']['size'][$i] / 1024 > 3072) {
                echo '<div class="notification is-danger is-light">La imagen ' . $image_name . ' supera el límite de peso permitido</div>';
                exit();
            }

            /* Extensión de las imágenes */
            $img_ext = ($image_type === 'image/jpeg') ? ".jpg" : ".png";

            /* Cambiando permisos al directorio */
            chmod($img_dir, 0777);

            /* Nombre de la imagen */
            $img_nombre = renombrar_fotos($post_id);

            /* Nombre final de la imagen */
            $foto = $img_nombre . '_' . $i . $img_ext;

            /* Moviendo imagen al directorio */
            if (!move_uploaded_file($image_tmp, $img_dir . $foto)) {
                echo '<div class="notification is-danger is-light">No podemos subir la imagen ' . $image_name . ' al sistema en este momento, por favor intente nuevamente</div>';
                exit();
            } else {
                $fotos[] = $foto;
            }
        }
    }

    /* Comprobando si se han seleccionado imágenes */
    if (isset($_FILES['post_foto']) && !empty($_FILES['post_foto']['name'][0])) {
        //... el código que funciona que has compartido Backmente...

        /* Recuperando las fotos existentes del post */
        $consulta_fotos = conexion();
        $consulta_fotos = $consulta_fotos->query("SELECT post_foto FROM post WHERE post_id = '$post_id'");
        $resultado_fotos = $consulta_fotos->fetch(PDO::FETCH_ASSOC);

        if ($resultado_fotos) {
            $fotos_existentes = json_decode($resultado_fotos['post_foto'], true);
            $fotos = array_merge($fotos_existentes, $fotos); // Combina las fotos existentes con las nuevas
        }

        $fotos_json = json_encode($fotos); // Convierte la matriz de fotos en una cadena JSON

        /* Actualizando la base de datos con las nuevas fotos */
        $actualizar_post = conexion();
        $actualizar_post = $actualizar_post->prepare("UPDATE post SET post_foto = :foto WHERE post_id = :post_id");

        $marcadores = [
            ":foto" => $fotos_json,
            ":post_id" => $post_id,
        ];

        $actualizar_post->execute($marcadores);

        if ($actualizar_post->rowCount() == 1) {
            echo '<div class="notification is-info is-light">
                    <strong>PHOTOS ADDED!</strong><br>
                    Las fotos se registraron con éxito
                </div>';
        } else {
            foreach ($fotos as $foto) {
                if (is_file($img_dir . $foto)) {
                    chmod($img_dir . $foto, 0777);
                    unlink($img_dir . $foto);
                }
            }

            echo '<div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se pudo registrar la foto, por favor intente nuevamente
                </div>';
        }
        $actualizar_post = null;
    }
?>
