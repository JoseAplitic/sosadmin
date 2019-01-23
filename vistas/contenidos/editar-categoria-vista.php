<div class="breadcrumbs animated fadeIn">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>EDITAR CATEGORÍA</h1>
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
                            <li class="active">Editar categoría</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
						<strong class="card-title">Editar categoría</strong>
					</div>
					<div class="card-body">
						<?php if (isset($_POST['categoria-id-editar'])):
							$sql = $insAdmin->obtener_info_taxonomia_controlador($_POST['categoria-id-editar']);
							if($sql->rowCount()>=1):
								$datos=$sql->fetch();
								$nombre = $datos['nombre'];
								$slug = $datos['slug'];
								$descripcion = $datos['descripcion'];
								$padre = $datos['padre'];
								$icono = $datos['icono'];
								?>
						<form action="<?php echo SERVERURL; ?>ajax/administradorAjax.php" method="POST" data-form="update" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="categoria-id-editar" value="<?php echo $_POST['categoria-id-editar']; ?>">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label for="entrada-titulo" class="form-control-label">Nombre *</label>
										<input id="entrada-titulo" type="text" name="categoria-nombre-editar" placeholder="" class="form-control" value="<?php echo $nombre; ?>" required="">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="entrada-slug" class=" form-control-label">Slug *</label>
										<input id="entrada-slug" type="text" name="categoria-slug-editar" placeholder="" class="form-control" value="<?php echo $slug; ?>" required="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="categoria-descripcion-editar" class=" form-control-label">Descripción</label>
										<input id="categoria-descripcion-editar" type="text" name="categoria-descripcion-editar" placeholder="" value="<?php echo $descripcion; ?>" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="categoria-padre-editar" class=" form-control-label">Categoría superior</label>
										<select id="categoria-padre-editar" name="categoria-padre-editar" data-placeholder="Choose a Country..." class="standardSelect" tabindex="1">
											<option value="<?php echo $padre; ?>" label="default"><?php echo $padre; ?></option>
											<option value="0">Ninguna</option>
											<option value="United States">United States</option>
											<option value="United Kingdom">United Kingdom</option>
											<option value="Afghanistan">Afghanistan</option>
											<option value="Aland Islands">Aland Islands</option>
											<option value="Albania">Albania</option>
											<option value="Algeria">Algeria</option>
											<option value="American Samoa">American Samoa</option>
											<option value="Andorra">Andorra</option>
											<option value="Angola">Angola</option>
											<option value="Anguilla">Anguilla</option>
											<option value="Antarctica">Antarctica</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="categoria-icono-editar" class=" form-control-label">Icono</label>
										<select id="categoria-icono-editar" name="categoria-icono-editar" data-placeholder="Choose a Country..." class="standardSelect" tabindex="1">
											<option value="<?php echo $icono; ?>" label="default"><?php echo $icono; ?></option>
											<option value="" label="default"></option>
											<option value="United States">United States</option>
											<option value="United Kingdom">United Kingdom</option>
											<option value="Afghanistan">Afghanistan</option>
											<option value="Aland Islands">Aland Islands</option>
											<option value="Albania">Albania</option>
											<option value="Algeria">Algeria</option>
											<option value="American Samoa">American Samoa</option>
											<option value="Andorra">Andorra</option>
											<option value="Angola">Angola</option>
											<option value="Anguilla">Anguilla</option>
											<option value="Antarctica">Antarctica</option>
										</select>
									</div>
								</div>
							</div>
							<input class="btn btn-outline-info btn-block" type="submit" value="Guardar cambios" style="margin: 20px 0px;">
							<div class="RespuestaAjax"></div>
									</form>
							<?php else: ?>
								<p>Ha ocurrido un error al intentar cargar la información de este administrador</p>
								<button type="button" class="btn btn-primary" role="link" onclick="window.location='<?php echo SERVERURL; ?>usuarios/'">Ver todos los usuario</button>
							<?php endif ?>
						<?php else: ?>
							<p>No ha seleccionado ningun administardor para editar</p>
							<button type="button" class="btn btn-primary" role="link" onclick="window.location='<?php echo SERVERURL; ?>usuarios/'">Ver todos los usuario</button>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>

<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
			width: "100%",
			height: "200px"
        });
    });
</script>