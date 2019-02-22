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
								$icono2 = $datos['icono2'];
								$mostrar_imagen = false;
								$mostrar_url = "";
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
										<select id="categoria-padre-editar" name="categoria-padre-editar" data-placeholder="Elije una categoria..." class="standardSelect" tabindex="1">
										<?php if($padre > 0): ?>
											 <?php
												$categoriaPadre = $insAdmin->obtener_info_taxonomia_controlador($padre); 
												if($categoriaPadre->rowCount()>=1):
													$datosCategoriaPadre=$categoriaPadre->fetch();
													$padreId = $datosCategoriaPadre['id'];
													$padreNombre = $datosCategoriaPadre['nombre'];
												?>
													<option value="<?php echo $padreId; ?>" label="default"><?php echo $padreNombre; ?></option>
													<option value="">Ninguna</option>
													<?php echo $insAdmin->cargar_taxonomias_editar2_controlador("categoria", $_POST['categoria-id-editar'], $padre); ?>
												<?php else: ?>
													<option value="" label="default">Ninguna</option>
													<?php echo $insAdmin->cargar_taxonomias_editar_controlador("categoria", $_POST['categoria-id-editar']); ?>
												<?php endif; ?>
										<?php else: ?>
											<option value="" label="default">Ninguna</option>
											<?php echo $insAdmin->cargar_taxonomias_editar_controlador("categoria", $_POST['categoria-id-editar']); ?>
										<?php endif; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<p style="margin-top: 10px;"><strong>Reglas de precios</strong></p>
								</div>
								<?php 
									$reglas = $insAdmin->obtener_reglas_controlador($_POST['categoria-id-editar']); 
									if($reglas->rowCount()>=1):
										$datosReglas=$reglas->fetch();
								?>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="categoria-visitantes-editar" class="form-control-label">Para visitantes *</label>
										<input id="categoria-visitantes-editar" type="number" min="0" value="<?php echo $datosReglas['regla_visitantes']; ?>" step="any" name="categoria-visitantes-editar" placeholder="" class="form-control" required="">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="categoria-usuarios-editar" class="form-control-label">Para usuarios registrados *</label>
										<input id="categoria-usuarios-editar" type="number" min="0" value="<?php echo $datosReglas['regla_usuarios']; ?>" step="any" name="categoria-usuarios-editar" placeholder="" class="form-control" required="">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="categoria-empresas-editar" class="form-control-label">Para empresas *</label>
										<input id="categoria-empresas-editar" type="number" min="0" value="<?php echo $datosReglas['regla_empresas']; ?>" step="any" name="categoria-empresas-editar" placeholder="" class="form-control" required="">
									</div>
								</div>
									<?php else: ?>
								<div class="col-12">
									<p style="margin-top: 10px;">Ocurio un error al cargar las reglas</p>
								</div>
									<?php endif; ?>
							</div>
							<div class="row">
								<div class="col-9">
									<div class="form-group">
										<label for="categoria-icono-editar" class=" form-control-label">Icono para fondos claros</label>
										<select id="categoria-icono-editar" name="categoria-icono-editar" data-placeholder="Elije un icono..." class="standardSelect" tabindex="1">
										<?php if($icono > 0): ?>
												<?php
												$categoriaIcono = $insAdmin->obtener_info_medios_controlador($icono); 
												if($categoriaIcono->rowCount()>=1):
													$datosCategoriaIcono=$categoriaIcono->fetch();
													$iconoId = $datosCategoriaIcono['id'];
													$iconoTitulo = $datosCategoriaIcono['titulo'];
													$iconoUrl = $datosCategoriaIcono['url'];
													$mostrar_imagen = true;
													$mostrar_url = $iconoUrl;
												?>
													<option value="<?php echo $iconoId; ?>" label="default"  data-url-image="<?php echo $iconoUrl; ?>"><?php echo $iconoTitulo;?></option>
													<option value="" data-url-image="">Ninguno</option>
													<?php echo $insAdmin->cargar_medios_editar_controlador($icono); ?>
												<?php else: ?>
													<option value="" label="default" data-url-image="">Ninguno</option>
													<?php echo $insAdmin->cargar_medios_controlador($icono); ?>
												<?php endif; ?>
										<?php else: ?>
											<option value="" label="default" data-url-image="">Ninguno</option>
											<?php echo $insAdmin->cargar_medios_controlador($icono); ?>
										<?php endif; ?>
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<?php if ($mostrar_imagen == true): ?>
										<img id="imagen-cambiar" src="<?php echo $mostrar_url; ?>" class="sombra">
									<?php else: ?>
										<img id="imagen-cambiar" src="" class="sombra">
									<?php endif; ?>
								</div>
							</div>
							<div class="row">
								<div class="col-9">
									<div class="form-group">
										<label for="categoria-icono2-editar" class=" form-control-label">Icono para fondos oscuros</label>
										<select id="categoria-icono2-editar" name="categoria-icono2-editar" data-placeholder="Elije un icono2..." class="standardSelect" tabindex="1">
										<?php if($icono2 > 0): ?>
												<?php
												$categoriaIcono2 = $insAdmin->obtener_info_medios_controlador($icono2); 
												if($categoriaIcono2->rowCount()>=1):
													$datosCategoriaIcono2=$categoriaIcono2->fetch();
													$icono2Id = $datosCategoriaIcono2['id'];
													$icono2Titulo = $datosCategoriaIcono2['titulo'];
													$icono2Url = $datosCategoriaIcono2['url'];
													$mostrar_imagen = true;
													$mostrar_url = $icono2Url;
												?>
													<option value="<?php echo $icono2Id; ?>" label="default"  data-url-image="<?php echo $icono2Url; ?>"><?php echo $icono2Titulo;?></option>
													<option value="" data-url-image="">Ninguno</option>
													<?php echo $insAdmin->cargar_medios_editar_controlador($icono2); ?>
												<?php else: ?>
													<option value="" label="default" data-url-image="">Ninguno</option>
													<?php echo $insAdmin->cargar_medios_controlador($icono2); ?>
												<?php endif; ?>
										<?php else: ?>
											<option value="" label="default" data-url-image="">Ninguno</option>
											<?php echo $insAdmin->cargar_medios_controlador($icono2); ?>
										<?php endif; ?>
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<?php if ($mostrar_imagen == true): ?>
										<img id="imagen-cambiar2" src="<?php echo $mostrar_url; ?>" class="sombra">
									<?php else: ?>
										<img id="imagen-cambiar2" src="" class="sombra">
									<?php endif; ?>
								</div>
							</div>
							<?php
								$existeVista = false;
								$arraySlides = array();
								$arrayModulos = array();
								$arrayMarcas = array();
								$arrayBanner = array();
								$datosVista = [
									"slides"=>json_encode($arraySlides),
									"columnas"=>json_encode($arrayModulos),
									"marcas"=>json_encode($arrayMarcas),
									"banner"=>json_encode($arrayBanner)
								];
								$imprimir = "";
								$sql = $insAdmin->obtener_vista_controlador($_POST['categoria-id-editar']);
								if($sql->rowCount()>=1)
								{
									$datosVista=$sql->fetch();
									$existeVista = true;
									$imprimir = 'checked = ""';
								}
							?>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="categoria-vista-editar" class=" form-control-label">Vista personalizada</label>
										<label class="container">SI
											<input id="categoria-vista-editar" name="categoria-vista-editar" type="checkbox" class="checkbox-vista" <?php echo $imprimir; ?>>
											<span class="checkmark"></span>
										</label>
									</div>
								</div>
							</div>
							<div id="custom-view-content" class="row">
								<div class="col-12">
									<div class="custom-tab">
										<nav style="margin-bottom: 20px;">
											<div class="nav nav-tabs" id="nav-tab" role="tablist">
												<a class="nav-item nav-link active show" id="custom-nav-slides-tab" data-toggle="tab" href="#custom-nav-slides" role="tab" aria-controls="custom-nav-slides" aria-selected="true">Slides</a>
												<a class="nav-item nav-link" id="custom-nav-columnas-tab" data-toggle="tab" href="#custom-nav-columnas" role="tab" aria-controls="custom-nav-columnas" aria-selected="false">Módulos</a>
												<a class="nav-item nav-link" id="custom-nav-marcas-tab" data-toggle="tab" href="#custom-nav-marcas" role="tab" aria-controls="custom-nav-marcas" aria-selected="false">Marcas</a>
												<a class="nav-item nav-link" id="custom-nav-banner-tab" data-toggle="tab" href="#custom-nav-banner" role="tab" aria-controls="custom-nav-banner" aria-selected="false">Banner publicitario</a>
											</div>
										</nav>
										<div class="tab-content pl-3 pt-2" id="nav-tabContent">
											<div class="tab-pane fade active show" id="custom-nav-slides" role="tabpanel" aria-labelledby="custom-nav-slides-tab">
												<?php echo $insAdmin->cargar_vista_categoria_controlador($datosVista, "slides"); ?>
											</div>
											<div class="tab-pane fade" id="custom-nav-columnas" role="tabpanel" aria-labelledby="custom-nav-columnas-tab">
												<?php echo $insAdmin->cargar_vista_categoria_controlador($datosVista, "modulos"); ?>
											</div>
											<div class="tab-pane fade" id="custom-nav-marcas" role="tabpanel" aria-labelledby="custom-nav-columnas-tab">
												<?php echo $insAdmin->cargar_vista_categoria_controlador($datosVista, "marcas"); ?>
											</div>
											<div class="tab-pane fade" id="custom-nav-banner" role="tabpanel" aria-labelledby="custom-nav-banner-tab">
												<?php echo $insAdmin->cargar_vista_categoria_controlador($datosVista, "banner"); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<input class="btn btn-outline-info btn-block" type="submit" value="Guardar cambios" style="margin: 20px 0px;">
							<div class="RespuestaAjax"></div>
						</form>
							<?php else: ?>
								<p>Ha ocurrido un error al intentar cargar la información de esta categoria</p>
								<button type="button" class="btn btn-primary" role="link" onclick="window.location='<?php echo SERVERURL; ?>categorias/'">Ver todas las categorías</button>
							<?php endif ?>
						<?php else: ?>
							<p>No ha seleccionado ningún categoría para editar</p>
							<button type="button" class="btn btn-primary" role="link" onclick="window.location='<?php echo SERVERURL; ?>categorias/'">Ver todas las categorías</button>
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
            no_results_text: "Vaya, no se ha encontrado nada!",
			width: "100%",
			height: "200px"
        });
    });
</script>