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
                <li>
                    <a href="<?php echo SERVERURL; ?>inicio/"><i class="menu-icon fas fa-home"></i>Escritorio</a>
                </li>
                <li class="menu-title">Tienda</li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-boxes"></i>Productos</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-boxes"></i><a href="<?php echo SERVERURL; ?>productos/">Todos los productos</a></li>
                        <li><i class="fas fa-plus-circle"></i><a href="<?php echo SERVERURL; ?>nuevo-producto/">Agregar productos</a></li>
                        <li><i class="fas fa-search"></i><a href="<?php echo SERVERURL; ?>buscar-productos/">Buscar productos</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-list-ul"></i>Categorías</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-list-ul"></i><a href="<?php echo SERVERURL; ?>categorias/">Todas las categorías</a></li>
                        <li><i class="fas fa-plus-circle"></i><a href="<?php echo SERVERURL; ?>nueva-categoria/">Agregar categoría</a></li>
                        <li><i class="fas fa-search"></i><a href="<?php echo SERVERURL; ?>buscar-categorias/">Buscar categorías</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-tags"></i>Etiquetas</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-tags"></i><a href="<?php echo SERVERURL; ?>etiquetas/">Todas las etiquetas</a></li>
                        <li><i class="fas fa-plus-circle"></i><a href="<?php echo SERVERURL; ?>nueva-etiqueta/">Agregar etiqueta</a></li>
                        <li><i class="fas fa-search"></i><a href="<?php echo SERVERURL; ?>buscar-etiquetas/">Buscar etiquetas</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-thumbtack"></i>Atributos</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-thumbtack"></i><a href="<?php echo SERVERURL; ?>atributos/">Todos los atributos</a></li>
                        <li><i class="fas fa-plus-circle"></i><a href="<?php echo SERVERURL; ?>nuevo-atributo/">Agregar atributo</a></li>
                        <li><i class="fas fa-search"></i><a href="<?php echo SERVERURL; ?>buscar-atributos/">Buscar atributos</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon far fa-gem"></i>Marcas</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="far fa-gem"></i><a href="<?php echo SERVERURL; ?>marcas/">Todos los marcas</a></li>
                        <li><i class="fas fa-plus-circle"></i><a href="<?php echo SERVERURL; ?>nueva-marca/">Agregar marca</a></li>
                        <li><i class="fas fa-search"></i><a href="<?php echo SERVERURL; ?>buscar-marcas/">Buscar marcas</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fas fa-cart-arrow-down"></i>Descuentos</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fas fa-cart-arrow-down"></i><a href="<?php echo SERVERURL; ?>descuentos/">Todos los descuentos</a></li>
                        <li><i class="fas fa-plus-circle"></i><a href="<?php echo SERVERURL; ?>nuevo-descuento/">Agregar descuento</a></li>
                        <li><i class="fas fa-search"></i><a href="<?php echo SERVERURL; ?>buscar-descuentos/">Buscar descuentos</a></li>
                    </ul>
                </li>
                <li class="menu-title">Medios</li>
                <li>
                    <a href="<?php echo SERVERURL; ?>medios/"> <i class="menu-icon far fa-images"></i>Medios</a>
                    <a href="<?php echo SERVERURL; ?>buscar-medios/"> <i class="menu-icon fas fa-search"></i>Buscar medios</a>
                </li>
                <?php if ($_SESSION['id'] == 1): ?>
                <li class="menu-title">Usuarios</li>
                <li>
                    <a href="<?php echo SERVERURL; ?>usuarios/"> <i class="menu-icon fas fa-users"></i>Todos los usuarios</a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>nuevo-usuario/"> <i class="menu-icon fas fa-user-plus"></i>Añadir nuevo</a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>buscar-usuarios/"> <i class="menu-icon fas fa-search"></i>Buscar usuarios</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</aside>