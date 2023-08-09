<div class="container is-fluid mb-1">
	<h1 class="title">Posts</h1>
	<h2 class="subtitle">Update post</h2>
</div>

<div class="container pb-6 pt-1">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['post_id_up'])) ? $_GET['post_id_up'] : 0;
		$id=limpiar_cadena($id);

		/*== Verificando post ==*/
    	$check_post=conexion();
    	$check_post=$check_post->query("SELECT * FROM post WHERE post_id='$id'");

        if($check_post->rowCount()>0){
        	$datos=$check_post->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>
	
	<h2 class="title has-text-centered"><?php echo $datos['post_nombre']; ?></h2>

	<form action="./php/admin_post_update.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="post_id" value="<?php echo $datos['post_id']; ?>" required >

		<div class="rows">
		<div class="column">
				<label>Category</label><br>
		    	<div class="select is-rounded">
				  	<select name="admin_post_category" >
				    	<?php
    						$categories=conexion();
    						$categories=$categories->query("SELECT * FROM category");
    						if($categories->rowCount()>0){
    							$categories=$categories->fetchAll();
    							foreach($categories as $row){
    								if($datos['category_id']==$row['category_id']){
    									echo '<option value="'.$row['category_id'].'" selected="" >'.$row['category_name'].' (Actual)</option>';
    								}else{
    									echo '<option value="'.$row['category_id'].'" >'.$row['category_name'].'</option>';
    								}
				    			}
				   			}
				   			$categories=null;
				    	?>
				  	</select>
				</div>
		  	</div>
		</div>

		<div class="rows">
		<!-- Video Link -->
			<div class="column">
				<label>Video Link</label>
				<input class="input" type="text" name="post_video_link" maxlength="255" value="<?php echo $datos['post_video_link']; ?>">
			</div>
			<!-- Description -->
			<div class="column">
				<label>Description / Info about it</label>
				<textarea class="textarea" name="post_info" ><?php echo $datos['post_info']; ?></textarea>
			</div>
		</div>
		<div class="rows">
		<!-- Schedules -->
			<div class="column">
				<label>Schedules</label>
				<textarea class="textarea" name="post_schedules" ><?php echo $datos['post_schedules']; ?></textarea>
			</div>
			<!-- Ticket Price -->
			<div class="column">
				<label>Ticket Price</label>
				<input class="input" type="text" name="post_ticket_price" maxlength="255" value="<?php echo $datos['post_ticket_price']; ?>">
			</div>
		</div>
		<div class="rows">
			<!-- Ticket Link -->
			<div class="column">
				<label>Ticket Link</label>
				<input class="input" type="text" name="post_ticket_link" maxlength="255" value="<?php echo $datos['post_ticket_link']; ?>">
			</div>
			<!-- Official Link -->
			<div class="column">
				<label>Official Link</label>
				<input class="input" type="text" name="post_official_link" maxlength="255" value="<?php echo $datos['post_official_link']; ?>">
			</div>
		</div>
		<div class="rows">
			<!-- Prices -->
			<div class="column">
				<label>Prices</label>
				<input class="input" type="text" name="post_prices" maxlength="255" value="<?php echo $datos['post_prices']; ?>">
			</div>
			<!-- Tricks -->
			<div class="column">
				<label>Tricks</label>
				<textarea class="textarea" name="post_tricks" ><?php echo $datos['post_tricks']; ?></textarea>
			</div>
		</div>
		<div class="rows">
			<!-- Latitude -->
			<div class="column">
				<label>Latitude</label>
				<input class="input" type="text" name="post_latitude" pattern="[-]?[0-9]*[.,]?[0-9]*" maxlength="16" value="<?php echo $datos['post_latitude']; ?>">
			</div>
			<!-- Longitude -->
			<div class="column">
				<label>Longitude</label>
				<input class="input" type="text" name="post_longitude" pattern="[-]?[0-9]*[.,]?[0-9]*" maxlength="16" value="<?php echo $datos['post_longitude']; ?>">
			</div>
		</div>
		<div class="rows">

		<div class="rows">
			<!-- Neighborhood -->
			<div class="column">
				<label>Neighborhood</label>
				<input class="input" type="text" name="post_neighborhood" maxlength="255" value="<?php echo $datos['post_neighborhood']; ?>">
			</div>

			<div class="column">
				<label for="post_is_top_5">Is Top 5:</label>
				<input type="checkbox" id="post_is_top_5" name="post_is_top_5" <?php echo $datos['post_is_top_5'] ? 'checked' : ''; ?> >
			</div>
			<div class="column">
				<label>Position</label>
				<input class="input" type="number" name="post_position" min="1" max="999" value="<?php echo $datos['post_position']; ?>">
			</div>
			</div>

			<div class="column">
				<label for="post_is_active">Is Active:</label>
				<input type="checkbox" id="post_is_active" name="post_is_active" <?php echo $datos['post_is_active'] ? 'checked' : ''; ?>>
			</div>
		</div>
		<hr/>

		<div class="rows">
		  	<div class="column">
		    	<div class="control">
					<label>Código de barra</label>
				  	<input class="input" type="text" name="post_codigo" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required value="<?php echo $datos['post_codigo']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="post_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required value="<?php echo $datos['post_nombre']; ?>" >
				</div>
		  	</div>
		</div>
		<div class="rows">
		  	<div class="column">
		    	<div class="control">
					<label>Precio</label>
				  	<input class="input" type="text" name="post_precio" pattern="[0-9.]{1,25}" maxlength="25" required value="<?php echo $datos['post_precio']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Stock</label>
				  	<input class="input" type="text" name="post_stock" pattern="[0-9]{1,25}" maxlength="25" required value="<?php echo $datos['post_stock']; ?>" >
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
		$check_post=null;
	?>
</div>