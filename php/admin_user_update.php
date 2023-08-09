<?php
	require_once "../inc/session_start.php";

	require_once "main.php";

    /*== Almacenando id ==*/
    $id=limpiar_cadena($_POST['user_id']);

    /*== Verificando user ==*/
	$check_user=conexion();
	$check_user=$check_user->query("SELECT * FROM user WHERE user_id='$id'");

    if($check_user->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El user no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_user->fetch();
    }
    $check_user=null;


    /*== Almacenando datos del administrador ==*/
    $admin_user=limpiar_cadena($_POST['administrador_user']);
    $admin_password=limpiar_cadena($_POST['administrador_password']);


    /*== Verificando campos obligatorios del administrador ==*/
    if($admin_user=="" || $admin_password==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No ha llenado los campos que corresponden a su User o CLAVE
            </div>
        ';
        exit();
    }

    /*== Verificando integridad de los datos (admin) ==*/
    if(verificar_datos("[a-zA-Z0-9]{4,20}",$admin_user)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Su User no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$admin_password)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Su CLAVE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }


    /*== Verificando el administrador en DB ==*/
    $check_admin=conexion();
    $check_admin=$check_admin->query("SELECT user_user,user_password FROM user WHERE user_user='$admin_user' AND user_id='".$_SESSION['id']."'");
    if($check_admin->rowCount()==1){

    	$check_admin=$check_admin->fetch();

    	if($check_admin['user_user']!=$admin_user || !password_verify($admin_password, $check_admin['user_password'])){
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                User o CLAVE de administrador incorrectos
	            </div>
	        ';
	        exit();
    	}

    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                User o CLAVE de administrador incorrectos
            </div>
        ';
        exit();
    }
    $check_admin=null;


    /*== Almacenando datos del user ==*/
    $nombre=limpiar_cadena($_POST['user_nombre']);
    $apellido=limpiar_cadena($_POST['user_apellido']);

    $user=limpiar_cadena($_POST['user_user']);
    $email=limpiar_cadena($_POST['user_email']);

    $clave_1=limpiar_cadena($_POST['user_password_1']);
    $clave_2=limpiar_cadena($_POST['user_password_2']);


    /*== Verificando campos obligatorios del user ==*/
    if($nombre=="" || $apellido=="" || $user==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos (user) ==*/
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El APELLIDO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9]{4,20}",$user)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El User no coincide con el formato solicitado
            </div>
        ';
        exit();
    }


    /*== Verificando email ==*/
    if($email!="" && $email!=$datos['user_email']){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $check_email=conexion();
            $check_email=$check_email->query("SELECT user_email FROM user WHERE user_email='$email'");
            if($check_email->rowCount()>0){
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        El correo electrónico ingresado ya se encuentra registrado, por favor elija otro
                    </div>
                ';
                exit();
            }
            $check_email=null;
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    Ha ingresado un correo electrónico no valido
                </div>
            ';
            exit();
        } 
    }


    /*== Verificando user ==*/
    if($user!=$datos['user_user']){
	    $check_user=conexion();
	    $check_user=$check_user->query("SELECT user_user FROM user WHERE user_user='$user'");
	    if($check_user->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El User ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_user=null;
    }


    /*== Verificando claves ==*/
    if($clave_1!="" || $clave_2!=""){
    	if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_2)){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                Las CLAVES no coinciden con el formato solicitado
	            </div>
	        ';
	        exit();
	    }else{
		    if($clave_1!=$clave_2){
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                Las CLAVES que ha ingresado no coinciden
		            </div>
		        ';
		        exit();
		    }else{
		        $clave=password_hash($clave_1,PASSWORD_BCRYPT,["cost"=>10]);
		    }
	    }
    }else{
    	$clave=$datos['user_password'];
    }


    /*== Update datos ==*/
    $actualizar_user=conexion();
    $actualizar_user=$actualizar_user->prepare("UPDATE user SET user_nombre=:nombre,user_apellido=:apellido,user_user=:user,user_password=:clave,user_email=:email WHERE user_id=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":user"=>$user,
        ":clave"=>$clave,
        ":email"=>$email,
        ":id"=>$id
    ];

    if($actualizar_user->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡User ACTUALIZADO!</strong><br>
                El user se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el user, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_user=null;