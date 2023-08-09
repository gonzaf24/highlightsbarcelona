<?php
	require_once "../inc/session_start.php";

	require_once "main.php";

	/*== Almacenando datos ==*/
	$codigo=limpiar_cadena($_POST['post_codigo']);
	$nombre=limpiar_cadena($_POST['post_nombre']);
	$precio=limpiar_cadena($_POST['post_precio']);
	$stock=limpiar_cadena($_POST['post_stock']);
	$category=limpiar_cadena($_POST['admin_post_category']);

    $video_link = limpiar_cadena($_POST['post_video_link']);
    $info = limpiar_cadena($_POST['post_info']);
    $schedules = limpiar_cadena($_POST['post_schedules']);
    $ticket_price = limpiar_cadena($_POST['post_ticket_price']);
    $ticket_link = limpiar_cadena($_POST['post_ticket_link']);
    $official_link = limpiar_cadena($_POST['post_official_link']);
    $prices = limpiar_cadena($_POST['post_prices']);
    $tricks = limpiar_cadena($_POST['post_tricks']);
    $latitude = limpiar_cadena($_POST['post_latitude']);
    $longitude = limpiar_cadena($_POST['post_longitude']);
    $neighborhood = limpiar_cadena($_POST['post_neighborhood']);    
    $is_top_5 = limpiar_cadena($_POST['post_is_top_5'] == 'on') ? 1 : 0;
    $position = limpiar_cadena($_POST['post_position']);
    $is_active = limpiar_cadena($_POST['post_is_active'] == 'on') ? 1 : 0;


	/*== Verificando campos obligatorios ==*/
/*     if($codigo=="" || $nombre=="" || $precio=="" || $stock=="" || $category==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    } */


    /*== Verificando integridad de los datos ==*/
/*     if(verificar_datos("[a-zA-Z0-9- ]{1,70}",$codigo)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CODIGO de BARRAS no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    } */

/*     if(verificar_datos("[0-9.]{1,25}",$precio)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PRECIO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9]{1,25}",$stock)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El STOCK no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
 */

    /*== Verificando codigo ==*/
/*     $check_codigo=conexion();
    $check_codigo=$check_codigo->query("SELECT post_codigo FROM post WHERE post_codigo='$codigo'");
    if($check_codigo->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CODIGO de BARRAS ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_codigo=null; */


    /*== Verificando nombre ==*/
/*     $check_nombre=conexion();
    $check_nombre=$check_nombre->query("SELECT post_nombre FROM post WHERE post_nombre='$nombre'");
    if($check_nombre->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_nombre=null; */


    /*== Verificando category ==*/


    

    $check_category=conexion();
    $check_category=$check_category->query("SELECT category_id FROM category WHERE category_id='$category'");
    if($check_category->rowCount()<=0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La category seleccionada no existe
            </div>
        ';
        exit();
    }
    $check_category=null;


    /* Directorios de imagenes */
	$img_dir='../img/post/';

    $fotos = [];


	/*== Comprobando si se han seleccionado imágenes ==*/
    if (isset($_FILES['post_foto']) && !empty($_FILES['post_foto']['name'][0])) {
        $total_images = count($_FILES['post_foto']['name']);

        /* Creando directorio de imágenes */
        if (!file_exists($img_dir)) {
  
            if (!mkdir($img_dir, 0777)) {
                echo '<div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        Error al crear el directorio de imágenes
                    </div>';
                exit();
            }
        }

        /* Loop through each image */
        for ($i = 0; $i < $total_images; $i++) {
            $image_name = $_FILES['post_foto']['name'][$i];
            $image_tmp = $_FILES['post_foto']['tmp_name'][$i];

            /* Comprobando formato de las imágenes */
            if (mime_content_type($image_tmp) != "image/jpeg" && mime_content_type($image_tmp) != "image/png") {
                echo '<div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        La imagen ' . $image_name . ' tiene un formato no permitido
                    </div>';
                exit();
            }

            /* Comprobando que la imagen no supere el peso permitido */
            if ($_FILES['post_foto']['size'][$i] / 1024 > 3072) {
                echo '<div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        La imagen ' . $image_name . ' supera el límite de peso permitido
                    </div>';
                exit();
            }

            /* extensión de las imágenes */
            $img_ext = ($image_type === 'image/jpeg') ? ".jpg" : ".png";

            /* Cambiando permisos al directorio */
            chmod($img_dir, 0777);

            /* Nombre de la imagen */
            $img_nombre = renombrar_fotos($nombre);

            /* Nombre final de la imagen */
            $foto = $img_nombre . '_' . $i . $img_ext;

            /* Moviendo imagen al directorio */
            if (!move_uploaded_file($image_tmp, $img_dir . $foto)) {

                echo '$image_tmp: ' . $image_tmp . '<br>';
                echo '$img_dir: ' . $img_dir . '<br>';
                echo '$foto: ' . $foto . '<br>';

                echo '<div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        No podemos subir la imagen ' . $image_name . ' al sistema en este momento, por favor intente nuevamente
                    </div>';
                //exit();
            }else {
                $fotos[] = $foto; // Agregando la ruta de la imagen a la matriz
            }
        }
    } else {
        $foto = "";
    }

    echo "<div>is_top_5: " . $is_top_5 . "</div>";
    echo "<div>is_active: " . $is_active . "</div>";
    echo "<div>position: " . $position . "</div>";

	/*== Guardando datos ==*/
    $save_post=conexion();
    $save_post=$save_post->prepare("INSERT INTO post(
        post_codigo,
        post_nombre,
        post_precio,
        post_stock,
        post_foto,
        post_video_link,
        post_info,
        post_schedules,
        post_ticket_price,
        post_ticket_link,
        post_official_link,
        post_prices,
        post_tricks,
        post_latitude,
        post_longitude,
        post_neighborhood,
        post_is_top_5,
        post_position,
        post_is_active, 
        category_id,
        user_id) 
        VALUES(
        :codigo,
        :nombre,
        :precio,
        :stock,
        :foto,
        :video_link,
        :info,
        :schedules,
        :ticket_price,
        :ticket_link,
        :official_link,
        :prices,
        :tricks,
        :latitude,
        :longitude,
        :neighborhood,
        :is_top_5,
        :position,
        :is_active,
        :category,
        :user)");

    $fotos_json = json_encode($fotos);

    $marcadores=[
        ":codigo"=>$codigo,
        ":nombre"=>$nombre,
        ":precio"=>$precio,
        ":stock"=>$stock,
        ":foto" => $fotos_json, 
        ":video_link" => $video_link,
        ":info" => $info,
        ":schedules" => $schedules,
        ":ticket_price" => $ticket_price,
        ":ticket_link" => $ticket_link,
        ":official_link" => $official_link,
        ":prices" => $prices,
        ":tricks" => $tricks, 
        ":latitude" => $latitude,
        ":longitude" => $longitude,
        ":neighborhood" => $neighborhood,
        ":is_top_5" => $is_top_5,
        ":position" => $position,
        ":is_active" => $is_active,
        ":category"=>$category,
        ":user"=>$_SESSION['id'],
    ];

    $save_post->execute($marcadores);

    if($save_post->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡POST REGISTRADO!</strong><br>
                El post se registro con exito
            </div>
        ';
    }else{

    	if(is_file($img_dir.$foto)){
			chmod($img_dir.$foto, 0777);
			unlink($img_dir.$foto);
        }

        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el post, por favor intente nuevamente
            </div>
        ';
    }
    $save_post=null;