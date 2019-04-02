<div class="breadcrumbs animated fadeIn">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>CONFIGURACIÓN DE VISTA HOME</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?php echo SERVERURL; ?>inicio/">Escritorio</a></li>
                            <li class="active">Home Vista</li>
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

	<!-- Lista de marcas -->
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<strong class="card-title">Configuración</strong>
					</div>
					<div class="card-body">
                        <div class="col-12">
							<form action="<?php echo SERVERURL; ?>ajax/administradorAjax.php" method="POST" data-form="update" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
								<input type="hidden" name="vista-home-editar" value="home">
								<div class="custom-tab">
									<nav style="margin-bottom: 20px;">
										<div class="nav nav-tabs" id="nav-tab" role="tablist">
											<a class="nav-item nav-link active show" id="custom-nav-slides-tab" data-toggle="tab" href="#custom-nav-slides" role="tab" aria-controls="custom-nav-slides" aria-selected="false">Slides</a>
											<a class="nav-item nav-link" id="custom-nav-banner-tab" data-toggle="tab" href="#custom-nav-banner" role="tab" aria-controls="custom-nav-banner" aria-selected="false">Banner publicitario</a>
										</div>
									</nav>
									<?php

										$relaciones = [
											"slide1" => ["", ""],
											"slide2" => ["", ""],
											"slide3" => ["", ""],
											"slide4" => ["", ""],
											"slide5" => ["", ""],
											"slide6" => ["", ""],
											"slide7" => ["", ""],
											"slide8" => ["", ""],
											"slide9" => ["", ""],
											"slide10" => ["", ""],
											"banner1" => ["", ""],
											"banner2" => ["", ""]
										];

										$relacionesGuardadas = $insAdmin->obtener_datos_vistas("home");
										
										if($relacionesGuardadas->rowCount()>=1)
										{
											$datosRelaciones=$relacionesGuardadas->fetch();
											$arrayVista = json_decode($datosRelaciones['contenido'], true);
											$relaciones = [
												"slide1" => $arrayVista[0]['slide1'],
												"slide2" => $arrayVista[1]['slide2'],
												"slide3" => $arrayVista[2]['slide3'],
												"slide4" => $arrayVista[3]['slide4'],
												"slide5" => $arrayVista[4]['slide5'],
												"slide6" => $arrayVista[5]['slide6'],
												"slide7" => $arrayVista[6]['slide7'],
												"slide8" => $arrayVista[7]['slide8'],
												"slide9" => $arrayVista[8]['slide9'],
												"slide10" => $arrayVista[9]['slide10'],
												"banner1" => $arrayVista[10]['banner1'],
												"banner2" => $arrayVista[11]['banner2']
											];
										}

									?>
									<div class="tab-content pl-3 pt-2" id="nav-tabContent">
										<div class="tab-pane fade active show" id="custom-nav-slides" role="tabpanel" aria-labelledby="custom-nav-slides-tab">
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Slide 1</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-url-1-editar" class=" form-control-label">URL</label>
														<input id="home-slide-url-1-editar" type="url" name="home-slide-url-1-editar" placeholder="" class="form-control" value="<?php echo $relaciones['slide1'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-img-1-editar" class="form-control-label">Imagen</label>
														<select id="home-slide-img-1-editar" name="home-slide-img-1-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['slide1'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['slide1'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Slide 2</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-url-2-editar" class=" form-control-label">URL</label>
														<input id="home-slide-url-2-editar" type="url" name="home-slide-url-2-editar" placeholder="" class="form-control" value="<?php echo $relaciones['slide2'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-img-2-editar" class="form-control-label">Imagen</label>
														<select id="home-slide-img-2-editar" name="home-slide-img-2-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['slide2'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['slide2'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Slide 3</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-url-3-editar" class=" form-control-label">URL</label>
														<input id="home-slide-url-3-editar" type="url" name="home-slide-url-3-editar" placeholder="" class="form-control" value="<?php echo $relaciones['slide3'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-img-3-editar" class="form-control-label">Imagen</label>
														<select id="home-slide-img-3-editar" name="home-slide-img-3-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['slide3'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['slide3'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Slide 4</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-url-4-editar" class=" form-control-label">URL</label>
														<input id="home-slide-url-4-editar" type="url" name="home-slide-url-4-editar" placeholder="" class="form-control" value="<?php echo $relaciones['slide4'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-img-4-editar" class="form-control-label">Imagen</label>
														<select id="home-slide-img-4-editar" name="home-slide-img-4-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['slide4'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['slide4'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Slide 5</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-url-5-editar" class=" form-control-label">URL</label>
														<input id="home-slide-url-5-editar" type="url" name="home-slide-url-5-editar" placeholder="" class="form-control" value="<?php echo $relaciones['slide5'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-img-5-editar" class="form-control-label">Imagen</label>
														<select id="home-slide-img-5-editar" name="home-slide-img-5-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['slide5'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['slide5'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Slide 6</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-url-6-editar" class=" form-control-label">URL</label>
														<input id="home-slide-url-6-editar" type="url" name="home-slide-url-6-editar" placeholder="" class="form-control" value="<?php echo $relaciones['slide6'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-img-6-editar" class="form-control-label">Imagen</label>
														<select id="home-slide-img-6-editar" name="home-slide-img-6-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['slide6'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['slide6'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Slide 7</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-url-7-editar" class=" form-control-label">URL</label>
														<input id="home-slide-url-7-editar" type="url" name="home-slide-url-7-editar" placeholder="" class="form-control" value="<?php echo $relaciones['slide7'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-img-7-editar" class="form-control-label">Imagen</label>
														<select id="home-slide-img-7-editar" name="home-slide-img-7-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['slide7'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['slide7'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Slide 8</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-url-8-editar" class=" form-control-label">URL</label>
														<input id="home-slide-url-8-editar" type="url" name="home-slide-url-8-editar" placeholder="" class="form-control" value="<?php echo $relaciones['slide8'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-img-8-editar" class="form-control-label">Imagen</label>
														<select id="home-slide-img-8-editar" name="home-slide-img-8-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['slide8'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['slide8'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Slide 9</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-url-9-editar" class=" form-control-label">URL</label>
														<input id="home-slide-url-9-editar" type="url" name="home-slide-url-9-editar" placeholder="" class="form-control" value="<?php echo $relaciones['slide9'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-img-9-editar" class="form-control-label">Imagen</label>
														<select id="home-slide-img-9-editar" name="home-slide-img-9-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['slide9'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['slide9'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Slide 10</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-url-10-editar" class=" form-control-label">URL</label>
														<input id="home-slide-url-10-editar" type="url" name="home-slide-url-10-editar" placeholder="" class="form-control" value="<?php echo $relaciones['slide10'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-slide-img-10-editar" class="form-control-label">Imagen</label>
														<select id="home-slide-img-10-editar" name="home-slide-img-10-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['slide10'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['slide10'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="custom-nav-banner" role="tabpanel" aria-labelledby="custom-nav-banner-tab">
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Banner publicitario 1</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-banner-publicitario-url-1-editar" class=" form-control-label">URL</label>
														<input id="home-banner-publicitario-url-1-editar" type="url" name="home-banner-publicitario-url-1-editar" placeholder="" class="form-control" value="<?php echo $relaciones['banner1'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-banner-publicitario-img-1-editar" class="form-control-label">Imagen</label>
														<select id="home-banner-publicitario-img-1-editar" name="home-banner-publicitario-img-1-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['banner1'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['banner1'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
											<div class="row">
												<div class="col-12">
													<h3 class="pb-2 display-5">Banner publicitario 2</h3>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-banner-publicitario-url-2-editar" class=" form-control-label">URL</label>
														<input id="home-banner-publicitario-url-2-editar" type="url" name="home-banner-publicitario-url-2-editar" placeholder="" class="form-control" value="<?php echo $relaciones['banner2'][0]; ?>">
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="home-banner-publicitario-img-2-editar" class="form-control-label">Imagen</label>
														<select id="home-banner-publicitario-img-2-editar" name="home-banner-publicitario-img-2-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
															<option value="" data-url-image="">Ninguno</option>
															<?php echo $insAdmin->verificar_medios_controlador($relaciones['banner2'][1]); ?>
														</select>
													</div>
												</div>
												<div class="col-sm-2">
													<?php 
														$sql = $insAdmin->obtener_info_medios_controlador($relaciones['banner2'][1]);
														if($sql->rowCount()>=1)
														{
															$datos=$sql->fetch();
															echo '<img id="imagen-cambiar-vista" src="'.$datos['url'].'" class="sombra">';
															
														}
														else
														{
															echo '<img id="imagen-cambiar-vista" src="" class="sombra">';
														}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<input class="btn btn-outline-info btn-block" type="submit" value="Guardar cambios" style="margin: 20px 0px;">
								<div class="RespuestaAjax"></div>
							</form>
						</div>
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

		var url = jQuery('#producto-imagenes-editar option:selected',this).attr("data-url-image");
        jQuery('#imagen-cambiar').attr("src", url);
    });
</script>