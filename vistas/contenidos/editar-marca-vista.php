<div class="breadcrumbs animated fadeIn">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>EDITAR MARCA</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?php echo SERVERURL; ?>inicio/">Escritorio</a></li>
                            <li><a href="<?php echo SERVERURL; ?>productos/">Productos</a></li>
                            <li><a href="<?php echo SERVERURL; ?>marcas/">Marcas</a></li>
                            <li class="active">Editar Marca</li>
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

	<!-- Menu marcas -->
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<strong>Opciones</strong>
						<small>Manejo de marcas</small>
					</div>
					<div class="card-body">
						<button type="button" class="btn btn-primary" role="link" onclick="window.location='<?php echo SERVERURL; ?>marcas/'">Todas las marcas</button>
						<button type="button" class="btn btn-success" role="link" onclick="window.location='<?php echo SERVERURL; ?>nueva-marca/'">Agregar nueva</button>
						<button type="button" class="btn btn-info" role="link" onclick="window.location='<?php echo SERVERURL; ?>buscar-marcas/'">Buscar marca</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php 
		require_once "./controladores/administradorControlador.php";
		$insAdmin= new administradorControlador();
	?>

	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Editar marca</strong>
					</div>
					<div class="card-body">
						<?php if (isset($_POST['marca-id-editar'])):
							$sql = $insAdmin->obtener_info_taxonomia_controlador($_POST['marca-id-editar']);
							if($sql->rowCount()>=1):
								$datos=$sql->fetch();
								$nombre = $datos['nombre'];
								$slug = $datos['slug'];
								$descripcion = $datos['descripcion'];
								$icono = $datos['icono'];
								$icono2 = $datos['icono2'];
								$color = $datos['color'];
								$mostrar_imagen = false;
								?>
									<form action="<?php echo SERVERURL; ?>ajax/administradorAjax.php" method="POST" data-form="update" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
										<input type="hidden" name="marca-id-editar" value="<?php echo $_POST['marca-id-editar']; ?>">
										<div class="row">
											<div class="col-6">
												<div class="form-group">
													<label for="entrada-titulo" class="form-control-label">Nombre *</label>
													<input id="entrada-titulo" type="text" name="marca-nombre-editar" placeholder="" class="form-control" value="<?php echo $nombre; ?>" required="">
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="entrada-slug" class=" form-control-label">Slug *</label>
													<input id="entrada-slug" type="text" name="marca-slug-editar" placeholder="" class="form-control" value="<?php echo $slug; ?>" required="">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<div class="form-group">
													<label for="marca-descripcion-editar" class=" form-control-label">Descripción</label>
													<input id="marca-descripcion-editar" type="text" name="marca-descripcion-editar" placeholder="" value="<?php echo $descripcion; ?>" class="form-control">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-9">
												<div class="form-group">
													<label for="marca-icono-editar" class=" form-control-label">Logo para fondos claros</label>
													<select id="marca-icono-editar" name="marca-icono-editar" data-placeholder="Elije un icono..." class="standardSelect" tabindex="1">
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
													<label for="marca-icono2-editar" class=" form-control-label">Logo para fondos oscuros</label>
													<select id="marca-icono2-editar" name="marca-icono2-editar" data-placeholder="Elije un icono..." class="standardSelect" tabindex="1">
													<?php if($icono2 > 0): ?>
															<?php
															$categoriaIcono = $insAdmin->obtener_info_medios_controlador($icono2); 
															if($categoriaIcono->rowCount()>=1):
																$datosCategoriaIcono=$categoriaIcono->fetch();
																$icono2Id = $datosCategoriaIcono['id'];
																$icono2Titulo = $datosCategoriaIcono['titulo'];
																$icono2Url = $datosCategoriaIcono['url'];
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
													<?php else:  $mostrar_url = ""; ?>
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
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group">
													<label for="marca-color-editar" class="form-control-label">Color *</label>
													<input id="marca-color-editar" name="marca-color-editar" type="text" class="jscolor form-control" value="<?php echo $color; ?>" requiered="">
												</div>
											</div>
										</div>
										<?php
											$existeVista = false;
											$arraySlides = array();
											$arrayModulos = array();
											$arrayBanner = array();
											$arrayCabecera = array();
											$datosVista = [
												"slides"=>json_encode($arraySlides),
												"columnas"=>json_encode($arrayModulos),
												"banner"=>json_encode($arrayBanner),
												"cabecera"=>json_encode($arrayCabecera)
											];
											$imprimir = "";
											$sql = $insAdmin->obtener_vista_controlador($_POST['marca-id-editar']);
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
													<label for="marca-vista-editar" class=" form-control-label">Vista personalizada</label>
													<label class="container">SI
														<input id="marca-vista-editar" name="marca-vista-editar" type="checkbox" class="checkbox-vista" <?php echo $imprimir; ?>>
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
															<a class="nav-item nav-link active show" id="custom-nav-cabecera-tab" data-toggle="tab" href="#custom-nav-cabecera" role="tab" aria-controls="custom-nav-cabecera" aria-selected="true">Cabecera</a>
															<a class="nav-item nav-link" id="custom-nav-slides-tab" data-toggle="tab" href="#custom-nav-slides" role="tab" aria-controls="custom-nav-slides" aria-selected="true">Slides</a>
															<a class="nav-item nav-link" id="custom-nav-columnas-tab" data-toggle="tab" href="#custom-nav-columnas" role="tab" aria-controls="custom-nav-columnas" aria-selected="false">Módulos</a>
															<a class="nav-item nav-link" id="custom-nav-banner-tab" data-toggle="tab" href="#custom-nav-banner" role="tab" aria-controls="custom-nav-banner" aria-selected="false">Banner publicitario</a>
														</div>
													</nav>
													<div class="tab-content pl-3 pt-2" id="nav-tabContent">
														<div class="tab-pane fade active show" id="custom-nav-cabecera" role="tabpanel" aria-labelledby="custom-nav-cabecera-tab">
															<?php echo $insAdmin->cargar_vista_marca_controlador($datosVista, "cabecera"); ?>
														</div>
														<div class="tab-pane fade" id="custom-nav-slides" role="tabpanel" aria-labelledby="custom-nav-slides-tab">
															<?php echo $insAdmin->cargar_vista_marca_controlador($datosVista, "slides"); ?>
														</div>
														<div class="tab-pane fade" id="custom-nav-columnas" role="tabpanel" aria-labelledby="custom-nav-columnas-tab">
															<?php echo $insAdmin->cargar_vista_marca_controlador($datosVista, "modulos"); ?>
														</div>
														<div class="tab-pane fade" id="custom-nav-banner" role="tabpanel" aria-labelledby="custom-nav-banner-tab">
															<?php echo $insAdmin->cargar_vista_marca_controlador($datosVista, "banner"); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<input class="btn btn-outline-info btn-block" type="submit" value="Guardar cambios" style="margin: 20px 0px;">
										<div class="RespuestaAjax"></div>
									</form>
							<?php else: ?>
								<p>Ha ocurrido un error al intentar cargar la información de esta marca</p>
								<button type="button" class="btn btn-primary" role="link" onclick="window.location='<?php echo SERVERURL; ?>marcas/'">Ver todos las marcas</button>
							<?php endif ?>
						<?php else: ?>
							<p>No ha seleccionado ningun administardor para editar</p>
							<button type="button" class="btn btn-primary" role="link" onclick="window.location='<?php echo SERVERURL; ?>marcas/'">Ver todos las marcas</button>
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