<?php
if(!isset($_SESSION['id']) || !isset($_SESSION['nombre']) || !isset($_SESSION['apellido']))
{
    $url = SERVERURL;
    header("location: $url");
}
?>
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="<?php echo SERVERURL; ?>inicio/"><i class="menu-icon fas fa-home"></i>Escritorio</a>
                </li>
                <li class="menu-title">Ejemplos</li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Ejemplo</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-puzzle-piece"></i><a href="#">Ejemplo</a></li>
                        <li><i class="fa fa-puzzle-piece"></i><a href="#">Ejemplo</a></li>
                        <li><i class="fa fa-puzzle-piece"></i><a href="#">Ejemplo</a></li>
                        <li><i class="fa fa-puzzle-piece"></i><a href="#">Ejemplo</a></li>
                        <li><i class="fa fa-puzzle-piece"></i><a href="#">Ejemplo</a></li>
                        <li><i class="fa fa-puzzle-piece"></i><a href="#">Ejemplo</a></li>
                        <li><i class="fa fa-puzzle-piece"></i><a href="#">Ejemplo</a></li>
                    </ul>
                </li>
                <?php if ($_SESSION['id'] == 1): ?>
                <li class="menu-title">Usuarios</li>
                <li>
                    <a href="<?php echo SERVERURL; ?>usuarios/"> <i class="menu-icon fas fa-users"></i>Todos los usuario</a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>nuevo-usuario/"> <i class="menu-icon fas fa-user-plus"></i>Añadir nuevo</a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>buscar-usuarios/"> <i class="menu-icon fas fa-search"></i>Buscar usuarios</a>
                </li>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>