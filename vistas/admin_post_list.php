<div class="container is-fluid mb-1">
    <h1 class="title">Posts</h1>
    <h2 class="subtitle">Posts list</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        # Delete post #
        if(isset($_GET['post_id_del'])){
            require_once "./php/admin_post_delete.php";
        }

        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $category_id = (isset($_GET['category_id'])) ? $_GET['category_id'] : 0;

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=admin_post_list&page="; /* <== */
        $registros=15;
        $busqueda="";

        # Paginador post #
        require_once "./php/admin_post_list.php";
    ?>
</div>