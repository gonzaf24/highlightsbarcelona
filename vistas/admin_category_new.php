<div class="container is-fluid mb-1">
	<h1 class="title">Categories</h1>
	<h2 class="subtitle">New category</h2>
</div>

<div class="container pb-6 pt-1">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/admin_category_save.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="rows">
		  	<div class="column">
		    	<div class="control">
					<label>Name</label>
				  	<input class="input" type="text" name="category_name" maxlength="50" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Description</label>
					<textarea class="input" name="category_description" maxlength="500" style="min-height: 250px;"></textarea>
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Create</button>
		</p>
	</form>
</div>