<?php
	/*== Almacenando datos ==*/
    $post_id_del=limpiar_cadena($_GET['post_id_del']);

    /*== Verificando post ==*/
    $check_post=conexion();
    $check_post=$check_post->query("SELECT * FROM post WHERE post_id='$post_id_del'");

    if($check_post->rowCount()==1){

    	$datos=$check_post->fetch();

    	$eliminar_post=conexion();
    	$eliminar_post=$eliminar_post->prepare("DELETE FROM post WHERE post_id=:id");

    	$eliminar_post->execute([":id"=>$post_id_del]);

    	if($eliminar_post->rowCount()==1){

    		if(is_file("./img/post/".$datos['post_foto'])){
    			chmod("./img/post/".$datos['post_foto'], 0777);
				unlink("./img/post/".$datos['post_foto']);
    		}

	        echo '
	            <div class="notification is-info is-light">
	                <strong>¡POST ELIMINADO!</strong><br>
	                Los datos del post se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el post, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_post=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El POST que intenta eliminar no existe
            </div>
        ';
    }
    $check_post=null;