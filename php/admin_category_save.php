<?php
	require_once "main.php";

    /*== Almacenando datos ==*/
    $name=limpiar_cadena($_POST['category_name']);
    $description=limpiar_cadena($_POST['category_description']);


    /*== Verificando campos obligatorios ==*/
    if($name==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
/*     if(verificar_datos("[a-zA-Z0-9\s.,!?]{5,500}",$name)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El name no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if($description!=""){
    	if(verificar_datos("[a-zA-Z0-9\s.,!?]{5,1000}",$description)){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La description no coincide con el formato solicitado
	            </div>
	        ';
	        exit();
	    }
    } */


    /*== Verificando name ==*/
    $check_name=conexion();
    $check_name=$check_name->query("SELECT category_name FROM category WHERE category_name='$name'");
    if($check_name->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El name ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_name=null;


    /*== Guardando datos ==*/
    $guardar_category=conexion();
    $guardar_category=$guardar_category->prepare("INSERT INTO category(category_name,category_description) VALUES(:name,:description)");

    $marcadores=[
        ":name"=>$name,
        ":description"=>$description
    ];

    $guardar_category->execute($marcadores);

    if($guardar_category->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡category REGISTRADA!</strong><br>
                La category se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar la category, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_category=null;