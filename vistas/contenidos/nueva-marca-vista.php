<div class="breadcrumbs animated fadeIn">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>AGREGAR MARCA</h1>
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
                            <li class="active">Agregar Marca</li>
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

	<!-- Vista para ingresar nueva marca -->
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Agregar nueva marca</strong>
					</div>
					<div class="card-body">
						<form action="<?php echo SERVERURL; ?>ajax/administradorAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
						<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label for="entrada-titulo" class="form-control-label">Nombre *</label>
										<input id="entrada-titulo" type="text" name="marca-nombre-nueva" placeholder="" class="form-control" required="">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="entrada-slug" class=" form-control-label">Slug *</label>
										<input id="entrada-slug" type="text" name="marca-slug-nueva" placeholder="" class="form-control" required="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="marca-descripcion-nueva" class=" form-control-label">Descripción</label>
										<input id="marca-descripcion-nueva" type="text" name="marca-descripcion-nueva" placeholder="" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-9">
									<div class="form-group">
										<label for="marca-icono-nueva" class=" form-control-label">Logo para fondos claros</label>
										<select id="marca-icono-nueva" name="marca-icono-nueva" data-placeholder="Elije un icono..." class="standardSelect" tabindex="1">
											<option value="" label="default" data-url-image="">Ninguno</option>
											<?php echo $insAdmin->cargar_medios_controlador(); ?>
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<img id="imagen-cambiar" src="" class="sombra">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-9">
									<div class="form-group">
										<label for="marca-icono2-nueva" class=" form-control-label">Logo para fondos oscuros</label>
										<select id="marca-icono2-nueva" name="marca-icono2-nueva" data-placeholder="Elije un icono..." class="standardSelect" tabindex="1">
											<option value="" label="default" data-url-image="">Ninguno</option>
											<?php echo $insAdmin->cargar_medios_controlador(); ?>
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<img id="imagen-cambiar2" src="" class="sombra">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="marca-color-nueva" class="form-control-label">Color *</label>
										<input id="marca-color-nueva" name="marca-color-nueva" type="text" class="jscolor form-control" value="FFFFFF" requiered="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="marca-vista-nueva" class=" form-control-label">Vista personalizada</label>
										<label class="container">SI
											<input id="marca-vista-nueva" name="marca-vista-nueva" type="checkbox" class="checkbox-vista">
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
												<a class="nav-item nav-link" id="custom-nav-banner-tab" data-toggle="tab" href="#custom-nav-banner" role="tab" aria-controls="custom-nav-banner" aria-selected="false">Banner publicitario</a>
											</div>
										</nav>
										<div class="tab-content pl-3 pt-2" id="nav-tabContent">
											<div class="tab-pane fade active show" id="custom-nav-slides" role="tabpanel" aria-labelledby="custom-nav-slides-tab">
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Slide 1</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-slide-url-1-nueva" class=" form-control-label">URL</label>
															<input id="marca-slide-url-1-nueva" type="url" name="marca-slide-url-1-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-slide-img-1-nueva" class="form-control-label">Imagen</label>
															<select id="marca-slide-img-1-nueva" name="marca-slide-img-1-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Slide 2</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-slide-url-2-nueva" class=" form-control-label">URL</label>
															<input id="marca-slide-url-2-nueva" type="url" name="marca-slide-url-2-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-slide-img-2-nueva" class="form-control-label">Imagen</label>
															<select id="marca-slide-img-2-nueva" name="marca-slide-img-2-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Slide 3</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-slide-url-3-nueva" class=" form-control-label">URL</label>
															<input id="marca-slide-url-3-nueva" type="url" name="marca-slide-url-3-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-slide-img-3-nueva" class="form-control-label">Imagen</label>
															<select id="marca-slide-img-3-nueva" name="marca-slide-img-3-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Slide 4</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-slide-url-4-nueva" class=" form-control-label">URL</label>
															<input id="marca-slide-url-4-nueva" type="url" name="marca-slide-url-4-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-slide-img-4-nueva" class="form-control-label">Imagen</label>
															<select id="marca-slide-img-4-nueva" name="marca-slide-img-4-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Slide 5</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-slide-url-5-nueva" class=" form-control-label">URL</label>
															<input id="marca-slide-url-5-nueva" type="url" name="marca-slide-url-5-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-slide-img-5-nueva" class="form-control-label">Imagen</label>
															<select id="marca-slide-img-5-nueva" name="marca-slide-img-5-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="custom-nav-columnas" role="tabpanel" aria-labelledby="custom-nav-columnas-tab">
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 1</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-1-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-1-nueva" type="url" name="marca-modulos-url-1-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-1-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-1-nueva" name="marca-modulos-img-1-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 2</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-2-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-2-nueva" type="url" name="marca-modulos-url-2-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-2-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-2-nueva" name="marca-modulos-img-2-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 3</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-3-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-3-nueva" type="url" name="marca-modulos-url-3-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-3-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-3-nueva" name="marca-modulos-img-3-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 4</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-4-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-4-nueva" type="url" name="marca-modulos-url-4-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-4-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-4-nueva" name="marca-modulos-img-4-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 5</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-5-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-5-nueva" type="url" name="marca-modulos-url-5-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-5-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-5-nueva" name="marca-modulos-img-5-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 6</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-6-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-6-nueva" type="url" name="marca-modulos-url-6-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-6-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-6-nueva" name="marca-modulos-img-6-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 7</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-7-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-7-nueva" type="url" name="marca-modulos-url-7-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-7-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-7-nueva" name="marca-modulos-img-7-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 8</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-8-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-8-nueva" type="url" name="marca-modulos-url-8-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-8-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-8-nueva" name="marca-modulos-img-8-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 9</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-9-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-9-nueva" type="url" name="marca-modulos-url-9-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-9-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-9-nueva" name="marca-modulos-img-9-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 10</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-10-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-10-nueva" type="url" name="marca-modulos-url-10-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-10-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-10-nueva" name="marca-modulos-img-10-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 11</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-11-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-11-nueva" type="url" name="marca-modulos-url-11-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-11-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-11-nueva" name="marca-modulos-img-11-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 12</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-12-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-12-nueva" type="url" name="marca-modulos-url-12-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-12-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-12-nueva" name="marca-modulos-img-12-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 13</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-13-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-13-nueva" type="url" name="marca-modulos-url-13-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-13-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-13-nueva" name="marca-modulos-img-13-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 14</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-14-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-14-nueva" type="url" name="marca-modulos-url-14-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-14-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-14-nueva" name="marca-modulos-img-14-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Módulo 15</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-url-15-nueva" class=" form-control-label">URL</label>
															<input id="marca-modulos-url-15-nueva" type="url" name="marca-modulos-url-15-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-modulos-img-15-nueva" class="form-control-label">Imagen</label>
															<select id="marca-modulos-img-15-nueva" name="marca-modulos-img-15-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="custom-nav-banner" role="tabpanel" aria-labelledby="custom-nav-banner-tab">
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Banner publicitario</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-banner-publicitario-url-nueva" class=" form-control-label">URL</label>
															<input id="marca-banner-publicitario-url-nueva" type="url" name="marca-banner-publicitario-url-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="marca-banner-publicitario-img-nueva" class="form-control-label">Imagen</label>
															<select id="marca-banner-publicitario-img-nueva" name="marca-banner-publicitario-img-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
																<option value="" label="default" data-url-image="">Ninguno</option>
																<?php echo $insAdmin->cargar_medios_controlador(); ?>
															</select>
														</div>
													</div>
													<div class="col-sm-2">
														<img id="imagen-cambiar-vista" src="" class="sombra">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<input class="btn btn-outline-success btn-block" type="submit" value="Agregar nueva marca" style="margin: 20px 0px;">
							<div class="RespuestaAjax"></div>
						</form>
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