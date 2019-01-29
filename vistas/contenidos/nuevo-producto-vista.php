<div class="breadcrumbs animated fadeIn">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>AGREGAR PRODUCTO</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?php echo SERVERURL; ?>inicio/">Escritorio</a></li>
                            <li><a href="<?php echo SERVERURL; ?>productos/">Productos</a></li>
                            <li class="active">Nuevo Producto</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">

	<!-- Menu usuarios -->
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<strong>Opciones</strong>
						<small>Manejo de productos</small>
					</div>
					<div class="card-body">
						<button type="button" class="btn btn-primary" role="link" onclick="window.location='<?php echo SERVERURL; ?>productos/'">Todos los productos</button>
						<button type="button" class="btn btn-success" role="link" onclick="window.location='<?php echo SERVERURL; ?>nuevo-producto/'">Agregar nuevo</button>
						<button type="button" class="btn btn-info" role="link" onclick="window.location='<?php echo SERVERURL; ?>buscar-productos/'">Buscar productos</button>
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
						<strong class="card-title">Agregar nuevo producto</strong>
					</div>
					<div class="card-body">
						<form action="<?php echo SERVERURL; ?>ajax/administradorAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
							<div class="custom-tab">
								<nav style="margin-bottom: 20px;">
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<a class="nav-item nav-link active show" id="custom-nav-principal-tab" data-toggle="tab" href="#custom-nav-principal" role="tab" aria-controls="custom-nav-principal" aria-selected="true">Principal</a>
										<a class="nav-item nav-link" id="custom-nav-taxonomias-tab" data-toggle="tab" href="#custom-nav-taxonomias" role="tab" aria-controls="custom-nav-taxonomias" aria-selected="false">Taxonomías</a>
										<a class="nav-item nav-link" id="custom-nav-detalles-tab" data-toggle="tab" href="#custom-nav-detalles" role="tab" aria-controls="custom-nav-detalles" aria-selected="false">Más detalles</a>
									</div>
								</nav>
								<div class="tab-content pl-3 pt-2" id="nav-tabContent">
									<div class="tab-pane fade active show" id="custom-nav-principal" role="tabpanel" aria-labelledby="custom-nav-principal-tab">
										<div class="row">
											<div class="col-12">
												<div class="form-group">
													<label for="producto-sku-nuevo" class=" form-control-label">SKU *</label>
													<input id="producto-sku-nuevo" type="text" name="producto-sku-nuevo" placeholder="" class="form-control" required="">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<div class="form-group">
													<label for="entrada-titulo" class="form-control-label">Nombre *</label>
													<input id="entrada-titulo" type="text" name="producto-nombre-nuevo" placeholder="" class="form-control" required="">
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="entrada-slug" class=" form-control-label">Slug *</label>
													<input id="entrada-slug" type="text" name="producto-slug-nuevo" placeholder="" class="form-control" required="">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<div class="form-group">
													<label for="producto-descripcion-nuevo" class=" form-control-label">Descripción</label>
													<input id="producto-descripcion-nuevo" type="text" name="producto-descripcion-nuevo" placeholder="" class="form-control">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<div class="form-group">
													<label for="producto-precio-nuevo" class="form-control-label">Precio *</label>
													<input id="producto-precio-nuevo" type="number" min="0" value="0" step="any" name="producto-precio-nuevo" placeholder="" class="form-control" required="">
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="producto-visitantes-nuevo" class="form-control-label">Precio Visitantes *</label>
													<input id="producto-visitantes-nuevo" type="number" min="0" value="0" step="any" name="producto-visitantes-nuevo" placeholder="" class="form-control" required="">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<div class="form-group">
													<label for="producto-usuarios-nuevo" class="form-control-label">Precio Usuarios *</label>
													<input id="producto-usuarios-nuevo" type="number" min="0" value="0" step="any" name="producto-usuarios-nuevo" placeholder="" class="form-control" required="">
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="producto-empresas-nuevo" class="form-control-label">Precio Empresas *</label>
													<input id="producto-empresas-nuevo" type="number" min="0" value="0" step="any" name="producto-empresas-nuevo" placeholder="" class="form-control" required="">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-9">
												<div class="form-group">
													<label for="producto-imagenes-nuevo" class=" form-control-label">Imágenes para galería</label>
													<select id="producto-imagenes-nuevo" multiple name="producto-imagenes-nuevo[]" data-placeholder="Elije las imágenes..." class="standardSelect" tabindex="1">
                        								<option value="" label="default"></option>
														<?php echo $insAdmin->cargar_medios_controlador(); ?>
													</select>
												</div>
											</div>
											<div class="col-sm-3">
												<img id="imagen-cambiar" src="" class="sombra">
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="custom-nav-taxonomias" role="tabpanel" aria-labelledby="custom-nav-taxonomias-tab">
										<div class="row">
											<div class="col-12">
												<div class="form-group">
													<label for="producto-categoria-nuevo" class=" form-control-label">Categoría</label>
													<select id="producto-categoria-nuevo" name="producto-categoria-nuevo" data-placeholder="Elije un icono..." class="standardSelect" tabindex="1">
														<option value="" label="default">Ninguna</option>
														<?php echo $insAdmin->cargar_taxonomias_controlador("categoria"); ?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<div class="form-group">
													<label for="producto-etiqueta-nuevo" multiple class=" form-control-label">Etiquetas</label>
													<select id="producto-etiqueta-nuevo" multiple name="producto-etiqueta-nuevo[]" data-placeholder="Elije las etiqeutas..." class="standardSelect" tabindex="1">
                        								<option value="" label="default"></option>
														<?php echo $insAdmin->cargar_taxonomias_controlador("etiqueta"); ?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<div class="form-group">
													<label for="producto-atributo-nuevo" class=" form-control-label">Atributos</label>
													<select id="producto-atributo-nuevo" name="producto-atributo-nuevo[]" data-placeholder="Atributos" multiple="" class="standardSelect" tabindex="-1">
                        								<option value="" label="default"></option>
														<?php echo $insAdmin->cargar_atributos_controlador(); ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="custom-nav-detalles" role="tabpanel" aria-labelledby="custom-nav-detalles-tab">
										<div class="row">
											<div class="col-6">
												<div class="form-group">
													<label for="producto-mpn-nuevo" class=" form-control-label">MPN</label>
													<input id="producto-mpn-nuevo" type="text" name="producto-mpn-nuevo" placeholder="" class="form-control">
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="producto-fabricante-nuevo" class=" form-control-label">Fabricante</label>
													<input id="producto-fabricante-nuevo" type="text" name="producto-fabricante-nuevo" placeholder="" class="form-control">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<div class="form-group">
													<label for="producto-tipo-nuevo" class=" form-control-label">Tipo</label>
													<input id="producto-tipo-nuevo" type="text" name="producto-tipo-nuevo" placeholder="" class="form-control">
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="producto-stock-nuevo" class="form-control-label">Stock</label>
													<input id="producto-stock-nuevo" type="number" min="0" value="0" step="any" name="producto-stock-nuevo" placeholder="" class="form-control">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												<div class="form-group">
													<label for="producto-nuevo-nuevo" class=" form-control-label">¿Nuevo?</label>
													<label class="container">SI
														<input id="producto-nuevo-nuevo" name="producto-nuevo-nuevo" type="checkbox">
														<span class="checkmark"></span>
													</label>
												</div>
											</div>
											<div class="col-6">
												<div class="form-group">
													<label for="producto-oferta-nuevo" class=" form-control-label">¿En oferta?</label>
													<label class="container">SI
														<input id="producto-oferta-nuevo" name="producto-oferta-nuevo" type="checkbox">
														<span class="checkmark"></span>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<input class="btn btn-outline-success btn-block" type="submit" value="Agregar nuevo producto" style="margin: 20px 0px;">
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