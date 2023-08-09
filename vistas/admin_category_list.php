<div class="container is-fluid mb-1">
    <h1 class="title">Categories</h1>
    <h2 class="subtitle">List de category</h2>
</div>

<div class="container pb-6 pt-1">
    <?php
        require_once "./php/main.php";

        # Delete category #
        if(isset($_GET['category_id_del'])){
            require_once "./php/admin_category_delete.php";
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
        $url="index.php?vista=admin_category_list&page="; /* <== */
        $registros=15;
        $busqueda="";

        # Paginador category #
        require_once "./php/admin_category_list.php";
    ?>
</div>