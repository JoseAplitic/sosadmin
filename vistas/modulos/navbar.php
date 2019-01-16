<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="./"><img src="<?php echo SERVERURL;?>vistas/assets/img/logo.png" alt="Logo" style="max-height: 40px;"></a>
            <a class="navbar-brand hidden" href="./"><img src="<?php echo SERVERURL;?>vistas/assets/img/logo.png" alt="Logo" style="max-height: 40px;"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">

            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="iniciales-usuario"><p><?php echo substr($_SESSION['nombre'], 0, 1);echo substr($_SESSION['apellido'], 0, 1); ?></p></div>
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="<?php echo SERVERURL;?>perfil-usuario/"><i class="fa fa-user"></i>Mi perfil</a>
                    <a class="nav-link btn-exit-system" href="#"><i class="fa fa-power-off"></i>Cerrar sesión</a>
                </div>
            </div>

        </div>
    </div>
</header>