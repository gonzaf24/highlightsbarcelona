<?php
	/*== Almacenando datos ==*/
    $user=limpiar_cadena($_POST['admin_login_user']);
    $clave=limpiar_cadena($_POST['admin_login_password']);


    /*== Verificando campos obligatorios ==*/
    if($user=="" || $clave==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9]{4,20}",$user)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El User no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las CLAVE no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }


    $check_user=conexion();
    $check_user=$check_user->query("SELECT * FROM user WHERE user_user='$user'");
    if($check_user->rowCount()==1){

    	$check_user=$check_user->fetch();

    	if($check_user['user_user']==$user && password_verify($clave, $check_user['user_password'])){

    		$_SESSION['id']=$check_user['user_id'];
    		$_SESSION['nombre']=$check_user['user_nombre'];
    		$_SESSION['apellido']=$check_user['user_apellido'];
    		$_SESSION['user']=$check_user['user_user'];

    		if(headers_sent()){
				echo "<script> window.location.href='index.php?vista=_admin_home'; </script>";
			}else{
				header("Location: index.php?vista=admin_home");
			}

    	}else{
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                User o clave incorrectos
	            </div>
	        ';
    	}
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                User o clave incorrectos
            </div>
        ';
    }
    $check_user=null;