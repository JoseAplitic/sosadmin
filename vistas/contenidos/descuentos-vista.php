<div class="breadcrumbs animated fadeIn">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>TODOS LOS DESCUENTOS</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?php echo SERVERURL; ?>inicio/">Escritorio</a></li>
                            <li class="active">Descuentos</li>
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
						<small>Manejo de descuentos</small>
					</div>
					<div class="card-body">
						<button type="button" class="btn btn-primary" role="link" onclick="window.location='<?php echo SERVERURL; ?>descuentos/'">Todos los descuentos</button>
						<button type="button" class="btn btn-success" role="link" onclick="window.location='<?php echo SERVERURL; ?>nuevo-descuento/'">Agregar nuevo</button>
						<button type="button" class="btn btn-info" role="link" onclick="window.location='<?php echo SERVERURL; ?>buscar-descuentos/'">Buscar descuentos</button>
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
						<strong class="card-title">Todos los descuentos</strong>
					</div>
					<div class="card-body">
						<div class="table-stats order-table ov-h">
							<?php 
								$pagina = explode("/", $_GET['views']);
								echo $insAdmin->paginador_descuentos_controlador($pagina[1],10,"");
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>