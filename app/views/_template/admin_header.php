<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            </div>

            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="<?= ADMIN_IMAGES_DIR ?>admin.jpg" alt="User Avatar">
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="<?= HOST_NAME . $_SESSION['loggedin']->role ?>/profile"><i class="fa fa- user"></i>My Profile</a>
                        <a class="nav-link" href="<?= HOST_NAME . $_SESSION['loggedin']->role ?>/signout"><i class="fa fa-power -off"></i>Logout</a>
                    </div>
                </div>

            </div>
        </div>

    </header><!-- /header -->
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">

        <div class="col-sm-12" id="admin-messages">
            <?php if (isset($_SESSION['adminMessages'])) : ?>
                <script>
                    adminMessages("<?= $_SESSION['adminMessages'][0] ?>", "<?= $_SESSION['adminMessages'][1] ?>");
                </script>
                <?php unset($_SESSION['adminMessages']); ?>
            <?php endif; ?>
        </div>

</div>


