<div class="container is-fluid mb-1">
    <h1 class="title">Posts</h1>
    <h2 class="subtitle">Post list by category</h2>
</div>

<div class="container pb-6 pt-1">
    <?php
        require_once "./php/main.php";
    ?>
    <div class="columns">
        <div class="column is-one-third">
            <h2 class="title has-text-centered">Categories</h2>
            <?php
                $categories=conexion();
                $categories=$categories->query("SELECT * FROM category");
                if($categories->rowCount()>0){
                    $categories=$categories->fetchAll();
                    foreach($categories as $row){
                        echo '<a href="index.php?vista=admin_post_category&category_id='.$row['category_id'].'" class="button is-link is-inverted is-fullwidth">'.$row['category_name'].'</a>';
                    }
                }else{
                    echo '<p class="has-text-centered" >No hay Categories registradas</p>';
                }
                $categories=null;
            ?>
        </div>
        <div class="column">
            <?php
                $category_id = (isset($_GET['category_id'])) ? $_GET['category_id'] : 0;

                /*== Verificando category ==*/
                $check_category=conexion();
                $check_category=$check_category->query("SELECT * FROM category WHERE category_id='$category_id'");

                if($check_category->rowCount()>0){

                    $check_category=$check_category->fetch();

                    echo '
                        <h2 class="title has-text-centered">'.$check_category['category_name'].'</h2>
                        <p class="has-text-centered pb-6" >'.$check_category['category_description'].'</p>
                    ';

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

                    $pagina=limpiar_cadena($pagina);
                    $url="index.php?vista=admin_post_category&category_id=$category_id&page="; /* <== */
                    $registros=15;
                    $busqueda="";

                    # Paginador post #
                    require_once "./php/admin_post_list.php";

                }else{
                    echo '<h2 class="has-text-centered title" >Seleccione una category para empezar</h2>';
                }
                $check_category=null;
            ?>
        </div>
    </div>
</div>