<?php
	require_once "./php/main.php";

    $id = (isset($_GET['user_id_up'])) ? $_GET['user_id_up'] : 0;
    $id=limpiar_cadena($id);
?>
<div class="container is-fluid mb-1">
	<?php if($id==$_SESSION['id']){ ?>
		<h1 class="title">My account</h1>
		<h2 class="subtitle">Update account data</h2>
	<?php }else{ ?>
		<h1 class="title">Users</h1>
		<h2 class="subtitle">Update user</h2>
	<?php } ?>
</div>

<div class="container pb-6 pt-1">
	<?php

		include "./inc/btn_back.php";

        /*== Verificando user ==*/
    	$check_user=conexion();
    	$check_user=$check_user->query("SELECT * FROM user WHERE user_id='$id'");

        if($check_user->rowCount()>0){
        	$datos=$check_user->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/admin_user_update.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="user_id" value="<?php echo $datos['user_id']; ?>" required >
		
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Name</label>
				  	<input class="input" type="text" name="user_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['user_nombre']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Surname</label>
				  	<input class="input" type="text" name="user_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['user_apellido']; ?>" >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>User</label>
				  	<input class="input" type="text" name="user_user" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required value="<?php echo $datos['user_user']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Email</label>
				  	<input class="input" type="email" name="user_email" maxlength="70" value="<?php echo $datos['user_email']; ?>" >
				</div>
		  	</div>
		</div>
		<br><br>
		<p class="has-text-centered">
				If you wish to update the password for this user, please fill in both fields. If you do NOT wish to update the password, leave the fields empty.		</p>
		<br>
		<div class="columns">
			<div class="column">
		    	<div class="control">
					<label>Password</label>
				  	<input class="input" type="password" name="user_password_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Retry password</label>
				  	<input class="input" type="password" name="user_password_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
				</div>
		  	</div>
		</div>
		<br><br><br>
		<p class="has-text-centered">
				To update the details of this user, please enter the USERNAME and PASSWORD with which you have logged in.
		</p>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>User</label>
				  	<input class="input" type="text" name="administrador_user" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Password</label>
				  	<input class="input" type="password" name="administrador_password" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Update</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_user=null;
	?>
</div>