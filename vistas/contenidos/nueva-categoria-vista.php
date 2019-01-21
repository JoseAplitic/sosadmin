<?php
if ($_SESSION['id'] != 1){
    $url = SERVERURL;
    echo '<script>location.href="'.$url.'"</script>';
}
?>
<div class="breadcrumbs animated fadeIn">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>AGREGAR CATEGORÍA</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?php echo SERVERURL; ?>inicio/">Escritorio</a></li>
                            <li><a href="<?php echo SERVERURL; ?>productos/">Productos</a></li>
                            <li><a href="<?php echo SERVERURL; ?>categorias/">Categorias</a></li>
                            <li class="active">Agregar categoría</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
	require_once "./controladores/administradorControlador.php";
	$insAdmin= new administradorControlador();
?>

<div class="content">

	<!-- Menu categorias -->
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<strong>Opciones</strong>
						<small>Manejo de categorías</small>
					</div>
					<div class="card-body">
						<button type="button" class="btn btn-primary" role="link" onclick="window.location='<?php echo SERVERURL; ?>categorias/'">Todas las categorias</button>
						<button type="button" class="btn btn-success" role="link" onclick="window.location='<?php echo SERVERURL; ?>nueva-categoria/'">Agregar categoría</button>
						<button type="button" class="btn btn-info" role="link" onclick="window.location='<?php echo SERVERURL; ?>buscar-categorias/'">Buscar categoría</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php 
		require_once "./controladores/administradorControlador.php";
		$insAdmin= new administradorControlador();
	?>

	<!-- Lista de usuarios -->
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Agregar nuevo usuario</strong>
					</div>
					<div class="card-body">
						<form action="<?php echo SERVERURL; ?>ajax/administradorAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label for="company" class=" form-control-label">Nombres *</label>
										<input type="text" name="usuario-nombre-nuevo" placeholder="" class="form-control" required="">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="company" class=" form-control-label">Apellidos *</label>
										<input type="text" name="usuario-apellido-nuevo" placeholder="" class="form-control" required="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label for="company" class=" form-control-label">Usuario *</label>
										<input type="text" name="usuario-usuario-nuevo" placeholder="" class="form-control" required="">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="company" class=" form-control-label">Correo *</label>
										<input type="email" name="usuario-correo-nuevo" placeholder="" class="form-control" required="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label for="company" class=" form-control-label">Contraseña *</label>
										<input type="password" name="usuario-contra1-nuevo" placeholder="" class="form-control" required="">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="company" class=" form-control-label">Repetir contraseña *</label>
										<input type="password" name="usuario-contra2-nuevo" placeholder="" class="form-control" required="">
									</div>
								</div>
							</div>
							<input class="btn btn-outline-success btn-block" type="submit" value="Agregar nuevo usuario" style="margin: 20px 0px;">
							<div class="RespuestaAjax"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>