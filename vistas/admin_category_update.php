<div class="container is-fluid mb-1">
	<h1 class="title">Categories</h1>
	<h2 class="subtitle">Update category</h2>
</div>

<div class="container pb-6 pt-1">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['category_id_up'])) ? $_GET['category_id_up'] : 0;
		$id=limpiar_cadena($id);

		/*== Verificando category ==*/
    	$check_category=conexion();
    	$check_category=$check_category->query("SELECT * FROM category WHERE category_id='$id'");

        if($check_category->rowCount()>0){
        	$datos=$check_category->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/admin_category_update.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="category_id" value="<?php echo $datos['category_id']; ?>" required >

		<div class="rows">
		  	<div class="column">
		    	<div class="control">
					<label>Name</label>
				  	<input class="input" type="text" name="category_name"  maxlength="50" required value="<?php echo $datos['category_name']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Description</label>
					<textarea class="input" name="category_description" maxlength="500" style="min-height: 250px;"><?php echo $datos['category_description']; ?></textarea>
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
		$check_category=null;
	?>
</div>