<?php
    
    require_once "main.php";

    /*== Almacenando datos ==*/
    $nombre=limpiar_cadena($_POST['user_nombre']);
    $apellido=limpiar_cadena($_POST['user_apellido']);

    $user=limpiar_cadena($_POST['user_user']);
    $email=limpiar_cadena($_POST['user_email']);

    $clave_1=limpiar_cadena($_POST['user_password_1']);
    $clave_2=limpiar_cadena($_POST['user_password_2']);


    /*== Verificando campos obligatorios ==*/
    if($nombre=="" || $apellido=="" || $user=="" || $clave_1=="" || $clave_2==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
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

    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave_2)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las CLAVES no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }


    /*== Verificando email ==*/
    if($email!=""){
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


    /*== Verificando claves ==*/
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


    /*== Guardando datos ==*/
    $guardar_user=conexion();
    $guardar_user=$guardar_user->prepare("INSERT INTO user(user_nombre,user_apellido,user_user,user_password,user_email) VALUES(:nombre,:apellido,:user,:clave,:email)");

    $marcadores=[
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":user"=>$user,
        ":clave"=>$clave,
        ":email"=>$email
    ];

    $guardar_user->execute($marcadores);

    if($guardar_user->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡User REGISTRADO!</strong><br>
                El user se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el user, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_user=null;