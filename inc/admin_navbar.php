<nav class="navbar" role="navigation" aria-label="main navigation">

    <div class="navbar-brand">
        <a class="navbar-item" href="index.php?vista=admin_home">
        <img src="./img/logo.png" width="65" height="28">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Users</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=admin_user_new" class="navbar-item">New</a>
                    <a href="index.php?vista=admin_user_list" class="navbar-item">List</a>
                    <a href="index.php?vista=admin_user_search" class="navbar-item">Buscar</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Categories</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=admin_category_new" class="navbar-item">New</a>
                    <a href="index.php?vista=admin_category_list" class="navbar-item">List</a>
                    <a href="index.php?vista=admin_category_search" class="navbar-item">Search</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Posts</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=admin_post_new" class="navbar-item">New</a>
                    <a href="index.php?vista=admin_post_list" class="navbar-item">List</a>
                    <a href="index.php?vista=admin_post_category" class="navbar-item">By category</a>
                    <a href="index.php?vista=admin_post_new" class="navbar-item">Search</a>
                </div>
            </div>

        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a href="index.php?vista=admin_user_update&user_id_up=<?php echo $_SESSION['id']; ?>" class="button is-primary is-rounded">
                        My account
                    </a>

                    <a href="index.php?vista=admin_logout" class="button is-link is-rounded">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>