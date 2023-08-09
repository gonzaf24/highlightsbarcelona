<div class="container is-fluid mb-1">
    <h1 class="title">Users</h1>
    <h2 class="subtitle">Users lists</h2>
</div>

<div class="container pb-6 pt-1">  
    <?php
        require_once "./php/main.php";

        # Delete user #
        if(isset($_GET['user_id_del'])){
            require_once "./php/admin_user_delete.php";
        }

        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=admin_user_list&page=";
        $registros=15;
        $busqueda="";

        # Paginador user #
        require_once "./php/admin_user_list.php";
    ?>
</div>