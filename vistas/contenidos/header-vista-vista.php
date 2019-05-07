<div class="breadcrumbs animated fadeIn">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>CONFIGURACIÓN DE VISTA HEADER</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?php echo SERVERURL; ?>inicio/">Escritorio</a></li>
                            <li class="active">Header Vista</li>
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
							<div class="custom-tab">
								<nav style="margin-bottom: 20px;">
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<a class="nav-item nav-link active show" id="custom-nav-categorias-tab" data-toggle="tab" href="#custom-nav-categorias" role="tab" aria-controls="custom-nav-categorias" aria-selected="true">Categorías destacadas</a>
										<a class="nav-item nav-link" id="custom-nav-marcas-tab" data-toggle="tab" href="#custom-nav-marcas" role="tab" aria-controls="custom-nav-marcas" aria-selected="false">Marcas</a>
									</div>
								</nav>
								<?php

									$relaciones = array();
									$relacionesGuardadas = $insAdmin->obtener_datos_vistas("header");
									
									if($relacionesGuardadas->rowCount()>=1)
									{
										$datosRelaciones=$relacionesGuardadas->fetch();
										$arrayVista = json_decode($datosRelaciones['contenido'], true);
										foreach($arrayVista['marcas'] as $datoVista)
										{
											array_push($relaciones, $datoVista);
										}
										foreach($arrayVista['categorias'] as $datoVista)
										{
											($relaciones, $datoVista);
										}
									}

								?>
								<form action="<?php echo SERVERURL; ?>ajax/administradorAjax.php" method="POST" data-form="update" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
									<input type="hidden" name="vista-header-editar" value="header">
									<div class="tab-content pl-3 pt-2" id="nav-tabContent">
										<div class="tab-pane fade active show" id="custom-nav-categorias" role="tabpanel" aria-labelledby="custom-nav-categorias-tab">
											<div class="row">
												<div class="col-12">
													<div class="form-group">
														<label for="vista-header-categoria-editar" class=" form-control-label">Categorías</label>
														<select id="vista-header-categoria-editar" multiple name="vista-header-categorias-editar[]" data-placeholder="Elije las categorías..." class="standardSelect" tabindex="1">
															<?php
																echo $insAdmin->relaciones_categorias_vista_controlador($relaciones);
															?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="custom-nav-marcas" role="tabpanel" aria-labelledby="custom-nav-marcas-tab">
											<div class="row">
												<div class="col-12">
													<div class="form-group">
														<label for="vista-header-marca-editar" class=" form-control-label">Marcas</label>
														<select id="vista-header-marca-editar" name="vista-header-marcas-editar[]" data-placeholder="Elije las marcas" multiple="" class="standardSelect" tabindex="-1">
															<?php
																echo $insAdmin->relaciones_marcas_vista_controlador($relaciones);
															?>
														</select>
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