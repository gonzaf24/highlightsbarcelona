<div class="container is-fluid mb-1">
	<h1 class="title">Posts</h1>
	<h2 class="subtitle">New post</h2>
</div>

<div class="container pb-6 pt-1">
	<?php
		require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/admin_post_save.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >

		<div class="rows" style="display: flex; align-items: center; gap: 10px; ">
			<label class="ml-2">Category</label>
			<div class="select">
				<select name="admin_post_category" >
					<option value="" selected="" >Select one</option>
					<?php
						$categories=conexion();
						$categories=$categories->query("SELECT * FROM category");
						if($categories->rowCount()>0){
							$categories=$categories->fetchAll();
							foreach($categories as $row){
								echo '<option value="'.$row['category_id'].'" >'.$row['category_name'].'</option>';
							}
						}
						$categories=null;
					?>
				</select>
			</div>
		</div>
		<br>
		<div class="rows" style="display: flex; align-items: center; gap: 10px; ">
				<label class="ml-2">Photos of the post</label><br>
				<div class="file is-small has-name">
				<label class="file-label">
					<input class="file-input" type="file" name="post_foto[]" accept=".jpg, .png, .jpeg" multiple>
					<span class="file-cta">
					<span class="file-label">Images</span>
					</span>
					<span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
				</label>
				</div>
		
		</div>
		<div class="rows">
			<!-- Video Link -->
			<div class="column">
				<label>Video Link</label>
				<input class="input" type="text" name="post_video_link" maxlength="255">
			</div>
			<!-- Description -->
			<div class="column">
				<label>Description/ Information about it</label>
				<textarea class="textarea" name="post_info"></textarea>
			</div>
		</div>
		<div class="rows">
			<!-- Schedules -->
			<div class="column">
				<label>Schedules</label>
				<textarea class="textarea" name="post_schedules"></textarea>
			</div>
			<!-- Ticket Price -->
			<div class="column">
				<label>Ticket Price</label>
				<input class="input" type="text" name="post_ticket_price" maxlength="255">
			</div>
		</div>
		<div class="rows">
			<!-- Ticket Link -->
			<div class="column">
				<label>Ticket Link</label>
				<input class="input" type="text" name="post_ticket_link" maxlength="255">
			</div>
			<!-- Official Link -->
			<div class="column">
				<label>Official Link</label>
				<input class="input" type="text" name="post_official_link" maxlength="255">
			</div>
		</div>
		<div class="rows">
			<!-- Prices -->
			<div class="column">
				<label>Prices</label>
				<input class="input" type="text" name="post_prices" maxlength="255">
			</div>
			<!-- Tricks -->
			<div class="column">
				<label>Tricks</label>
				<textarea class="textarea" name="post_tricks"></textarea>
			</div>
		</div>
		<div class="rows">
			<!-- Latitude -->
			<div class="column">
				<label>Latitude</label>
				<input class="input" type="text" name="post_latitude" maxlength="16">
			</div>
			<!-- Longitude -->
			<div class="column">
				<label>Longitude</label>
				<input class="input" type="text" name="post_longitude" maxlength="16">
			</div>
		</div>

		<div class="rows">
			<!-- Neighborhood -->
			<div class="column">
				<label>Neighborhood</label>
				<input class="input" type="text" name="post_neighborhood" maxlength="255">
			</div>
			
			<div class="column">
				<label for="post_is_top_5">Is Top 5:</label>
				<input type="checkbox" id="post_is_top_5" name="post_is_top_5">
			</div>
			<div class="column">
				<label>Position</label>
				<input class="input" type="number" name="post_position" min="1" max="999">
			</div>
			</div>

			<div class="column">
				<label for="post_is_active">Is Active:</label>
				<input type="checkbox" id="post_is_active" name="post_is_active">
			</div>
		</div>
						
		<hr/>

		<div class="rows">
		  	<div class="column">
		    	<div class="control">
					<label>Código de barra</label>
				  	<input class="input" type="text" name="post_codigo" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="post_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required >
				</div>
		  	</div>
		</div>
		<div class="rows">
		  	<div class="column">
		    	<div class="control">
					<label>Precio</label>
				  	<input class="input" type="text" name="post_precio" pattern="[0-9.]{1,25}" maxlength="25" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Stock</label>
				  	<input class="input" type="text" name="post_stock" pattern="[0-9]{1,25}" maxlength="25" required >
				</div>
		  	</div>
		  
		</div>
		
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>