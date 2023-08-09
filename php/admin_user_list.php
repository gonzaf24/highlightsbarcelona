<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM user WHERE ((user_id!='".$_SESSION['id']."') AND (user_nombre LIKE '%$busqueda%' OR user_apellido LIKE '%$busqueda%' OR user_user LIKE '%$busqueda%' OR user_email LIKE '%$busqueda%')) ORDER BY user_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(user_id) FROM user WHERE ((user_id!='".$_SESSION['id']."') AND (user_nombre LIKE '%$busqueda%' OR user_apellido LIKE '%$busqueda%' OR user_user LIKE '%$busqueda%' OR user_email LIKE '%$busqueda%'))";

	}else{

		$consulta_datos="SELECT * FROM user WHERE user_id!='".$_SESSION['id']."' ORDER BY user_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(user_id) FROM user WHERE user_id!='".$_SESSION['id']."'";
		
	}

	$conexion=conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);

	$tabla.='
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                	<th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>User</th>
                    <th>Email</th>
                    <th colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
	';

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			$tabla.='
				<tr class="has-text-centered" >
					<td>'.$contador.'</td>
                    <td>'.$rows['user_nombre'].'</td>
                    <td>'.$rows['user_apellido'].'</td>
                    <td>'.$rows['user_user'].'</td>
                    <td>'.$rows['user_email'].'</td>
                    <td>
                        <a href="index.php?vista=admin_user_update&user_id_up='.$rows['user_id'].'" class="button is-success is-rounded is-small">Update</a>
                    </td>
                    <td>
                        <a href="'.$url.$pagina.'&user_id_del='.$rows['user_id'].'" class="button is-danger is-rounded is-small">Delete</a>
                    </td>
                </tr>
            ';
            $contador++;
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}


	$tabla.='</tbody></table></div>';

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Showing users <strong>'.$pag_inicio.'</strong> to <strong>'.$pag_final.'</strong> of a <strong>total of '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}