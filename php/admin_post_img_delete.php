<?php
	require_once "main.php";

	/*== Almacenando datos ==*/
    $post_id=limpiar_cadena($_POST['img_del_id']);
    $img_name_to_delete=$_POST['img_name_to_delete']; // Obtener el nombre de la imagen a eliminar


    /*== Verificando post ==*/
    $check_post=conexion();
    $check_post=$check_post->query("SELECT * FROM post WHERE post_id='$post_id'");

    if($check_post->rowCount()==1){
    	$datos=$check_post->fetch();
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen del POST que intenta eliminar no existe
            </div>
        ';
        exit();
    }
    $check_post=null;


    /* Directorios de imagenes */
	$img_dir='../img/post/';

	/* Cambiando permisos al directorio */
	chmod($img_dir, 0777);

    $fotos = json_decode($datos['post_foto'], true);
    $key = array_search($img_name_to_delete, $fotos);
    if ($key !== false) {
        $img_path = $img_dir . $fotos[$key];
        if (is_file($img_path)) {
            chmod($img_path, 0777);
            if (!unlink($img_path)) {
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        Error al intentar eliminar la imagen del post, por favor intente nuevamente
                    </div>
                ';
                exit();
            }
            unset($fotos[$key]); // Delete la imagen del array
            $datos['post_foto'] = json_encode(array_values($fotos)); // Codificar el array actualizado como JSON
        }
    }

	/*== Actualizando datos ==*/
    $actualizar_post=conexion();
    $actualizar_post=$actualizar_post->prepare("UPDATE post SET post_foto=:foto WHERE post_id=:id");

    $marcadores=[
        ":foto" => $datos['post_foto'],
        ":id" => $post_id
    ];

    if($actualizar_post->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡IMAGEN O FOTO ELIMINADA!</strong><br>
                La imagen del post ha sido eliminada exitosamente, pulse Aceptar para recargar los cambios.

                <p class="has-text-centered pt-5 pb-5">
                    <a href="index.php?vista=admin_post_img&post_id_up='.$post_id.'" class="button is-link is-rounded">Aceptar</a>
                </p">
            </div>
        ';
    }else{
        echo '
            <div class="notification is-warning is-light">
                <strong>¡IMAGEN O FOTO ELIMINADA!</strong><br>
                Ocurrieron algunos inconvenientes, sin embargo la imagen del post ha sido eliminada, pulse Aceptar para recargar los cambios.

                <p class="has-text-centered pt-5 pb-5">
                    <a href="index.php?vista=admin_post_img&post_id_up='.$post_id.'" class="button is-link is-rounded">Aceptar</a>
                </p">
            </div>
        ';
    }
    $actualizar_post=null;