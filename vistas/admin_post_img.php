<div class="container is-fluid ">
	<h1 class="title">Posts</h1>
	<h2 class="subtitle">Photos</h2>
</div>

<div class="container pb-6 pt-0">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['post_id_up'])) ? $_GET['post_id_up'] : 0;

		/*== Verificando post ==*/
    	$check_post=conexion();
    	$check_post=$check_post->query("SELECT * FROM post WHERE post_id='$id'");

        if($check_post->rowCount()>0){
        	$datos=$check_post->fetch();
	?>
	<div class="form-rest mb-6 mt-6"></div>

	<div class="columns" style="justify-content: center">
		<div class="column is-two-fifths">

		<form action="./php/admin_admin_post_img_save.php" method="post" enctype="multipart/form-data" class="FormularioAjax">
			<input type="hidden" name="post_id"  value="<?php echo $datos['post_id']; ?>"> <!-- Asegúrate de reemplazar 123 con el ID real del post -->
			<div class="columns">
				<div class="column">
					<label>Photo or image of the post</label><br>
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
			</div>
			<button type="submit" class="button is-success is-rounded">Upload</button>
		</form>

			<br />
			<?php 
				$fotos = json_decode($datos['post_foto'], true);
				if(is_array($fotos) && !empty($fotos)) { 
			?>
			<?php foreach($fotos as $foto) { ?>
				<?php if(is_file("./img/post/" . $foto)) { ?>
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<figure class="image mb-6">
							<img src="./img/post/<?php echo $foto; ?>">
						</figure>
						<form class="FormularioAjax" action="./php/admin_admin_post_img_delete.php" method="POST" autocomplete="off">
							<input type="hidden" name="img_del_id" value="<?php echo $datos['post_id']; ?>">
							<input type="hidden" name="img_name_to_delete" value="<?php echo $foto; ?>"> 
							<p class="has-text-centered">
								<button type="submit" class="button is-danger is-rounded">Delete image</button>
							</p>
						</form>
					</div>
				<?php } else { ?>
					<figure class="image mb-6">
						<img src="./img/post.png">
					</figure>
				<?php } ?>
			<?php } ?>
			<?php } else { ?>
				<figure class="image mb-6">
					<img src="./img/post.png">
				</figure>
			<?php } ?>
		</div>

	
	</div>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_post=null;
	?>
</div>