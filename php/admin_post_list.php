<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	$campos="post.post_id,post.post_codigo,post.post_nombre,post.post_precio,post.post_stock,post.post_foto,post.category_id,post.user_id,category.category_id,category.category_name,user.user_id,user.user_nombre,user.user_apellido";

	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT $campos FROM post INNER JOIN category ON post.category_id=category.category_id INNER JOIN user ON post.user_id=user.user_id WHERE post.post_codigo LIKE '%$busqueda%' OR post.post_nombre LIKE '%$busqueda%' ORDER BY post.post_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(post_id) FROM post WHERE post_codigo LIKE '%$busqueda%' OR post_nombre LIKE '%$busqueda%'";

	}elseif($category_id>0){

		$consulta_datos="SELECT $campos FROM post INNER JOIN category ON post.category_id=category.category_id INNER JOIN user ON post.user_id=user.user_id WHERE post.category_id='$category_id' ORDER BY post.post_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(post_id) FROM post WHERE category_id='$category_id'";

	}else{

		$consulta_datos="SELECT $campos FROM post INNER JOIN category ON post.category_id=category.category_id INNER JOIN user ON post.user_id=user.user_id ORDER BY post.post_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(post_id) FROM post";

	}

	$conexion=conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);


	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			$photos = json_decode($rows['post_foto'], true);
			$tabla.='
				<article class="media">
			        <figure class="media-left">
			            <p class="image is-64x64">';
			            if(is_file("./img/post/".$photos[0])){
			            	$tabla.='<img src="./img/post/'.$photos[0].'">';
			            }else{
			            	$tabla.='<img src="./img/post.png">';
			            }
			   $tabla.='</p>
			        </figure>
			        <div class="media-content">
			            <div class="content">
			              <p>
			                <strong>'.$contador.' - '.$rows['post_nombre'].'</strong><br>
			                <strong>CODIGO:</strong> '.$rows['post_codigo'].', <strong>PRECIO:</strong> $'.$rows['post_precio'].', <strong>STOCK:</strong> '.$rows['post_stock'].', <strong>category:</strong> '.$rows['category_name'].', <strong>REGISTRADO POR:</strong> '.$rows['user_nombre'].' '.$rows['user_apellido'].'
			              </p>
			            </div>
			            <div class="has-text-right">
			                <a href="index.php?vista=admin_post_img&post_id_up='.$rows['post_id'].'" class="button is-link is-rounded is-small">Photos</a>
			                <a href="index.php?vista=admin_post_update&post_id_up='.$rows['post_id'].'" class="button is-success is-rounded is-small">Update</a>
			                <a href="'.$url.$pagina.'&post_id_del='.$rows['post_id'].'" class="button is-danger is-rounded is-small">Delete</a>
			            </div>
			        </div>
			    </article>

			    <hr>
            ';
            $contador++;
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$tabla.='
				<p class="has-text-centered" >
					<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
						Haga clic acá para recargar el listado
					</a>
				</p>
			';
		}else{
			$tabla.='
				<p class="has-text-centered" >No hay registros en el sistema</p>
			';
		}
	}

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Showing posts <strong>'.$pag_inicio.'</strong> to <strong>'.$pag_final.'</strong> of a <strong>total of '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}