<?php
	require_once "main.php";

	/*== Almacenando id ==*/
    $id=limpiar_cadena($_POST['category_id']);


    /*== Verificando category ==*/
	$check_category=conexion();
	$check_category=$check_category->query("SELECT * FROM category WHERE category_id='$id'");

    if($check_category->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La category no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_category->fetch();
    }
    $check_category=null;

    /*== Almacenando datos ==*/
    $nombre=limpiar_cadena($_POST['category_name']);
    $description=limpiar_cadena($_POST['category_description']);


    /*== Verificando campos obligatorios ==*/
    if($nombre==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if($description!=""){
    	if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}",$description)){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La description no coincide con el formato solicitado
	            </div>
	        ';
	        exit();
	    }
    }


    /*== Verificando nombre ==*/
    if($nombre!=$datos['category_name']){
	    $check_nombre=conexion();
	    $check_nombre=$check_nombre->query("SELECT category_name FROM category WHERE category_name='$nombre'");
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
    }


    /*== Update datos ==*/
    $actualizar_category=conexion();
    $actualizar_category=$actualizar_category->prepare("UPDATE category SET category_name=:nombre,category_description=:description WHERE category_id=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":description"=>$description,
        ":id"=>$id
    ];

    if($actualizar_category->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡category ACTUALIZADA!</strong><br>
                La category se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar la category, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_category=null;