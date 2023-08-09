<?php
	/*== Almacenando datos ==*/
    $category_id_del=limpiar_cadena($_GET['category_id_del']);

    /*== Verificando user ==*/
    $check_category=conexion();
    $check_category=$check_category->query("SELECT category_id FROM category WHERE category_id='$category_id_del'");
    
    if($check_category->rowCount()==1){

    	$check_posts=conexion();
    	$check_posts=$check_posts->query("SELECT category_id FROM post WHERE category_id='$category_id_del' LIMIT 1");

    	if($check_posts->rowCount()<=0){

    		$eliminar_category=conexion();
	    	$eliminar_category=$eliminar_category->prepare("DELETE FROM category WHERE category_id=:id");

	    	$eliminar_category->execute([":id"=>$category_id_del]);

	    	if($eliminar_category->rowCount()==1){
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡category ELIMINADA!</strong><br>
		                Los datos de la category se eliminaron con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar la category, por favor intente nuevamente
		            </div>
		        ';
		    }
		    $eliminar_category=null;
    	}else{
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No podemos eliminar la category ya que tiene posts asociados
	            </div>
	        ';
    	}
    	$check_posts=null;
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La category que intenta eliminar no existe
            </div>
        ';
    }
    $check_category=null;