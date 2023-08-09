<?php
	require_once "main.php";

	/*== Almacenando id ==*/
    $id=limpiar_cadena($_POST['post_id']);


    /*== Verificando post ==*/
	$check_post=conexion();
	$check_post=$check_post->query("SELECT * FROM post WHERE post_id='$id'");

    if($check_post->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El post no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_post->fetch();
    }
    $check_post=null;


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
    /* if(verificar_datos("[a-zA-Z0-9- ]{1,70}",$codigo)){
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
    }

    if(verificar_datos("[0-9.]{1,25}",$precio)){
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
    } */


    /*== Verificando codigo ==*/
    /* if($codigo!=$datos['post_codigo']){
	    $check_codigo=conexion();
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
	    $check_codigo=null;
    }
 */

    /*== Verificando nombre ==*/
   /*  if($nombre!=$datos['post_nombre']){
	    $check_nombre=conexion();
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
	    $check_nombre=null;
    } */


    /*== Verificando category ==*/
    if($category!=$datos['category_id']){
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
    }

    /*== Actualizando datos ==*/
    $actualizar_post=conexion();
    $actualizar_post=$actualizar_post->prepare("UPDATE post SET 
    post_codigo=:codigo,
    post_nombre=:nombre,
    post_precio=:precio,
    post_stock=:stock,
    post_video_link=:video_link,
    post_info=:info,
    post_schedules=:schedules,
    post_ticket_price=:ticket_price,
    post_ticket_link=:ticket_link,
    post_official_link=:official_link,
    post_prices=:prices,
    post_tricks=:tricks,
    post_latitude=:latitude,
    post_longitude=:longitude,
    post_neighborhood=:neighborhood,
    post_is_top_5=:is_top_5,
    post_position=:position,
    post_is_active=:is_active, 
    category_id=:category

    WHERE post_id=:id");

    $marcadores=[
        ":codigo"=>$codigo,
        ":nombre"=>$nombre,
        ":precio"=>$precio,
        ":stock"=>$stock,
        ":category"=>$category,
        ":video_link"=>$video_link,
        ":info"=>$info,
        ":schedules"=>$schedules,
        ":ticket_price"=>$ticket_price,
        ":ticket_link"=>$ticket_link,
        ":official_link"=>$official_link,
        ":prices"=>$prices,
        ":tricks"=>$tricks,
        ":latitude"=>$latitude,
        ":longitude"=>$longitude,
        ":neighborhood"=>$neighborhood,
        ":is_top_5"=>$is_top_5,
        ":position"=>$position,
        ":is_active"=>$is_active,
        ":id"=>$id
    ];

    if($actualizar_post->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡POST ACTUALIZADO!</strong><br>
                El post se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el post, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_post=null;