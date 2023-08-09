<?php

	/*== Almacenando datos ==*/
    $user_id_del=limpiar_cadena($_GET['user_id_del']);

    /*== Verificando user ==*/
    $check_user=conexion();
    $check_user=$check_user->query("SELECT user_id FROM user WHERE user_id='$user_id_del'");
    
    if($check_user->rowCount()==1){

    	$check_posts=conexion();
    	$check_posts=$check_posts->query("SELECT user_id FROM post WHERE user_id='$user_id_del' LIMIT 1");

    	if($check_posts->rowCount()<=0){
    		
	    	$eliminar_user=conexion();
	    	$eliminar_user=$eliminar_user->prepare("DELETE FROM user WHERE user_id=:id");

	    	$eliminar_user->execute([":id"=>$user_id_del]);

	    	if($eliminar_user->rowCount()==1){
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡User ELIMINADO!</strong><br>
		                Los datos del user se eliminaron con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar el user, por favor intente nuevamente
		            </div>
		        ';
		    }
		    $eliminar_user=null;
    	}else{
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No podemos eliminar el user ya que tiene posts registrados por el
	            </div>
	        ';
    	}
    	$check_posts=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El User que intenta eliminar no existe
            </div>
        ';
    }
    $check_user=null;