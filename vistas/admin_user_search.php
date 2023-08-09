<div class="container is-fluid mb-1">
    <h1 class="title">Users</h1>
    <h2 class="subtitle">Search user</h2>
</div>

<div class="container pb-6 pt-1">
    <?php
        require_once "./php/main.php";

        if(isset($_POST['modulo_buscador'])){
            require_once "./php/admin_searcher.php";
        }

        if(!isset($_SESSION['busqueda_user']) && empty($_SESSION['busqueda_user'])){
    ?>
    <div class="columns">
        <div class="column">
            <form action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="user">   
                <div class="field is-grouped">
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="text" name="txt_buscador" placeholder="¿Qué estas buscando?" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" maxlength="30" >
                    </p>
                    <p class="control">
                        <button class="button is-info" type="submit" >Search</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <?php }else{ ?>
    <div class="columns">
        <div class="column">
            <form class="has-text-centered mt-6 mb-6" action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="user"> 
                <input type="hidden" name="eliminar_buscador" value="user">
                <p>Estas buscando <strong>“<?php echo $_SESSION['busqueda_user']; ?>”</strong></p>
                <br>
                <button type="submit" class="button is-danger is-rounded">Delete search</button>
            </form>
        </div>
    </div>
    <?php
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
            $url="index.php?vista=admin_user_search&page="; /* <== */
            $registros=15;
            $busqueda=$_SESSION['busqueda_user']; /* <== */

            # Paginador user #
            require_once "./php/admin_user_list.php";
        } 
    ?>
</div>