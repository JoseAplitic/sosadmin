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

	<!-- Agregar usuario -->
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Agregar nueva categoría</strong>
					</div>
					<div class="card-body">
						<form action="<?php echo SERVERURL; ?>ajax/administradorAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label for="entrada-titulo" class="form-control-label">Nombre *</label>
										<input id="entrada-titulo" type="text" name="categoria-nombre-nueva" placeholder="" class="form-control" required="">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="entrada-slug" class=" form-control-label">Slug *</label>
										<input id="entrada-slug" type="text" name="categoria-slug-nueva" placeholder="" class="form-control" required="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="categoria-descripcion-nueva" class=" form-control-label">Descripción</label>
										<input id="categoria-descripcion-nueva" type="text" name="categoria-descripcion-nueva" placeholder="" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="categoria-padre-nueva" class=" form-control-label">Categoría superior</label>
										<select id="categoria-padre-nueva" name="categoria-padre-nueva" data-placeholder="Elije un icono..." class="standardSelect" tabindex="1">
											<option value="" label="default">Ninguna</option>
											<?php echo $insAdmin->cargar_taxonomias_controlador("categoria"); ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<p style="margin-top: 10px;"><strong>Reglas de precios</strong></p>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="categoria-visitantes-nueva" class="form-control-label">Para visitantes *</label>
										<input id="categoria-visitantes-nueva" type="number" min="0" value="0" step="any" name="categoria-visitantes-nueva" placeholder="" class="form-control" required="">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="categoria-usuarios-nueva" class="form-control-label">Para usuarios registrados *</label>
										<input id="categoria-usuarios-nueva" type="number" min="0" value="0" step="any" name="categoria-usuarios-nueva" placeholder="" class="form-control" required="">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="categoria-empresas-nueva" class="form-control-label">Para empresas *</label>
										<input id="categoria-empresas-nueva" type="number" min="0" value="0" step="any" name="categoria-empresas-nueva" placeholder="" class="form-control" required="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-9">
									<div class="form-group">
										<label for="categoria-icono-nueva" class=" form-control-label">Icono para fondos claros</label>
										<select id="categoria-icono-nueva" name="categoria-icono-nueva" data-placeholder="Elije un icono..." class="standardSelect" tabindex="1">
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
										<label for="categoria-icono2-nueva" class=" form-control-label">Icono para fondos oscuros</label>
										<select id="categoria-icono2-nueva" name="categoria-icono2-nueva" data-placeholder="Elije un icono..." class="standardSelect" tabindex="1">
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
								<div class="col-12">
									<div class="form-group">
										<label for="categoria-vista-nuevo" class=" form-control-label">Vista personalizada</label>
										<label class="container">SI
											<input id="categoria-vista-nuevo" name="categoria-vista-nuevo" type="checkbox">
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
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Slide 1</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-slide-url-1-nueva" class=" form-control-label">URL</label>
															<input id="categoria-slide-url-1-nueva" type="url" name="categoria-slide-url-1-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-slide-img-1-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-slide-img-1-nueva" name="categoria-slide-img-1-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-slide-url-2-nueva" class=" form-control-label">URL</label>
															<input id="categoria-slide-url-2-nueva" type="url" name="categoria-slide-url-2-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-slide-img-2-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-slide-img-2-nueva" name="categoria-slide-img-2-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-slide-url-3-nueva" class=" form-control-label">URL</label>
															<input id="categoria-slide-url-3-nueva" type="url" name="categoria-slide-url-3-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-slide-img-3-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-slide-img-3-nueva" name="categoria-slide-img-3-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-slide-url-4-nueva" class=" form-control-label">URL</label>
															<input id="categoria-slide-url-4-nueva" type="url" name="categoria-slide-url-4-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-slide-img-4-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-slide-img-4-nueva" name="categoria-slide-img-4-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-slide-url-5-nueva" class=" form-control-label">URL</label>
															<input id="categoria-slide-url-5-nueva" type="url" name="categoria-slide-url-5-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-slide-img-5-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-slide-img-5-nueva" name="categoria-slide-img-5-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-1-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-1-nueva" type="url" name="categoria-modulos-url-1-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-1-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-1-nueva" name="categoria-modulos-img-1-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-2-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-2-nueva" type="url" name="categoria-modulos-url-2-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-2-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-2-nueva" name="categoria-modulos-img-2-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-3-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-3-nueva" type="url" name="categoria-modulos-url-3-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-3-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-3-nueva" name="categoria-modulos-img-3-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-4-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-4-nueva" type="url" name="categoria-modulos-url-4-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-4-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-4-nueva" name="categoria-modulos-img-4-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-5-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-5-nueva" type="url" name="categoria-modulos-url-5-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-5-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-5-nueva" name="categoria-modulos-img-5-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-6-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-6-nueva" type="url" name="categoria-modulos-url-6-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-6-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-6-nueva" name="categoria-modulos-img-6-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-7-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-7-nueva" type="url" name="categoria-modulos-url-7-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-7-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-7-nueva" name="categoria-modulos-img-7-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-8-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-8-nueva" type="url" name="categoria-modulos-url-8-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-8-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-8-nueva" name="categoria-modulos-img-8-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-9-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-9-nueva" type="url" name="categoria-modulos-url-9-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-9-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-9-nueva" name="categoria-modulos-img-9-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-10-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-10-nueva" type="url" name="categoria-modulos-url-10-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-10-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-10-nueva" name="categoria-modulos-img-10-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-11-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-11-nueva" type="url" name="categoria-modulos-url-11-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-11-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-11-nueva" name="categoria-modulos-img-11-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-12-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-12-nueva" type="url" name="categoria-modulos-url-12-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-12-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-12-nueva" name="categoria-modulos-img-12-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-13-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-13-nueva" type="url" name="categoria-modulos-url-13-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-13-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-13-nueva" name="categoria-modulos-img-13-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-14-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-14-nueva" type="url" name="categoria-modulos-url-14-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-14-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-14-nueva" name="categoria-modulos-img-14-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-modulos-url-15-nueva" class=" form-control-label">URL</label>
															<input id="categoria-modulos-url-15-nueva" type="url" name="categoria-modulos-url-15-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-modulos-img-15-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-modulos-img-15-nueva" name="categoria-modulos-img-15-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
											<div class="tab-pane fade" id="custom-nav-marcas" role="tabpanel" aria-labelledby="custom-nav-marcas-tab">
												<div class="row">
													<div class="col-12">
														<h3 class="pb-2 display-5">Marca 1</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-1-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-1-nueva" type="url" name="categoria-marca-url-1-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-1-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-1-nueva" name="categoria-marca-img-1-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 2</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-2-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-2-nueva" type="url" name="categoria-marca-url-2-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-2-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-2-nueva" name="categoria-marca-img-2-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 3</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-3-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-3-nueva" type="url" name="categoria-marca-url-3-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-3-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-3-nueva" name="categoria-marca-img-3-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 4</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-4-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-4-nueva" type="url" name="categoria-marca-url-4-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-4-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-4-nueva" name="categoria-marca-img-4-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 5</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-5-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-5-nueva" type="url" name="categoria-marca-url-5-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-5-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-5-nueva" name="categoria-marca-img-5-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 6</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-6-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-6-nueva" type="url" name="categoria-marca-url-6-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-6-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-6-nueva" name="categoria-marca-img-6-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 7</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-7-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-7-nueva" type="url" name="categoria-marca-url-7-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-7-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-7-nueva" name="categoria-marca-img-7-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 8</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-8-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-8-nueva" type="url" name="categoria-marca-url-8-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-8-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-8-nueva" name="categoria-marca-img-8-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 9</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-9-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-9-nueva" type="url" name="categoria-marca-url-9-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-9-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-9-nueva" name="categoria-marca-img-9-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 10</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-10-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-10-nueva" type="url" name="categoria-marca-url-10-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-10-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-10-nueva" name="categoria-marca-img-10-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 11</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-11-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-11-nueva" type="url" name="categoria-marca-url-11-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-11-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-11-nueva" name="categoria-marca-img-11-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 12</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-12-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-12-nueva" type="url" name="categoria-marca-url-12-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-12-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-12-nueva" name="categoria-marca-img-12-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 13</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-13-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-13-nueva" type="url" name="categoria-marca-url-13-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-13-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-13-nueva" name="categoria-marca-img-13-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 14</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-14-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-14-nueva" type="url" name="categoria-marca-url-14-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-14-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-14-nueva" name="categoria-marca-img-14-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 15</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-15-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-15-nueva" type="url" name="categoria-marca-url-15-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-15-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-15-nueva" name="categoria-marca-img-15-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 16</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-16-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-16-nueva" type="url" name="categoria-marca-url-16-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-16-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-16-nueva" name="categoria-marca-img-16-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 17</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-17-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-17-nueva" type="url" name="categoria-marca-url-17-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-17-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-17-nueva" name="categoria-marca-img-17-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 18</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-18-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-18-nueva" type="url" name="categoria-marca-url-18-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-18-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-18-nueva" name="categoria-marca-img-18-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 19</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-19-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-19-nueva" type="url" name="categoria-marca-url-19-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-19-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-19-nueva" name="categoria-marca-img-19-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
														<h3 class="pb-2 display-5">Marca 20</h3>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-url-20-nueva" class=" form-control-label">URL</label>
															<input id="categoria-marca-url-20-nueva" type="url" name="categoria-marca-url-20-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-marca-img-20-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-marca-img-20-nueva" name="categoria-marca-img-20-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
															<label for="categoria-banner-publicitario-nueva" class=" form-control-label">URL</label>
															<input id="categoria-banner-publicitario-nueva" type="url" name="categoria-banner-publicitario-nueva" placeholder="" class="form-control">
														</div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<label for="categoria-banner-publicitario-nueva" class="form-control-label">Imagen</label>
															<select id="categoria-banner-publicitario-nueva" name="categoria-banner-publicitario-nueva" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
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
							<input class="btn btn-outline-success btn-block" type="submit" value="Agregar nueva categoría" style="margin: 20px 0px;">
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