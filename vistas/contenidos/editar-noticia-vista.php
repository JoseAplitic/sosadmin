<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-file-add zmdi-hc-fw"></i> Noticias <small>EDITAR</small></h1>
	</div>
	<p class="lead">Desde este panel puedes editar noticias</p>
</div>

<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
		<li>
	  		<a href="<?php echo SERVERURL; ?>noticias/" class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE NOTICIAS
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL; ?>nueva-noticia/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVA NOTICIA
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL; ?>buscar-noticia/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR NOTICIA
	  		</a>
	  	</li>
	</ul>
</div>
<?php 
	require_once "./controladores/administradorControlador.php";
	$insAdmin= new administradorControlador();
?>
<!-- Panel editar noticia -->
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; EDITAR INFO NOTICIAS</h3>
		</div>
		<div class="panel-body">
			<?php if (isset($_POST['noticia-id-editar'])):
				require_once './controladores/administradorControlador.php';
    			$administrador = new administradorControlador();
				$sql = $administrador->obtener_info_noticias_controlador($_POST['noticia-id-editar']);
				if($sql->rowCount()>=1):
					$datos=$sql->fetch();
					$titulo = $datos['titulo'];
					$contenido = $datos['contenido'];
					$imagen=$datos['imagen'];
					?>
						<form action="<?php echo SERVERURL; ?>ajax/noticiaAjax.php" method="POST" data-form="update" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
					    	<fieldset>
					    		<legend><i class="zmdi zmdi-collection-text"></i> &nbsp; Datos de la noticia</legend>
					    		<div class="container-fluid">
					    			<div class="row">
					    				<input type="hidden" name="noticia-id-editar" value="<?php echo $_POST['noticia-id-editar']; ?>">
					    				<div class="col-xs-12 col-sm-6">
									    	<div class="form-group label-floating">
											  	<label class="control-label">Titulo *</label>
											  	<input class="form-control" type="text" name="noticia-titulo-editar" required="" maxlength="200" value="<?php echo $titulo; ?>">
											</div>
					    				</div>
					    				<div class="col-xs-12">
											<div class="form-group label-floating">
											  	<label>Contenido *</label>
											  	<textarea name="noticia-contenido-editar"><?php echo $contenido; ?></textarea>
											</div>
					    				</div>
					    			</div>
					    		</div>
					    	</fieldset>
					    	<br>
					    	</fieldset>
						    <p class="text-center" style="margin-top: 20px;">
						    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
						    </p>
						    <div class="RespuestaAjax"></div>
					    </form>
						<form action="<?php echo SERVERURL; ?>ajax/noticiaAjax.php" method="POST" data-form="update" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
					    	<fieldset>
								<legend><i class="zmdi zmdi-image"></i> &nbsp; Imagen de la noticia</legend>
								<div class="col-xs-12">
									<div>
										<span class="control-label">Imagen Actual</span>
										<img style="width: 100%; height: 100%; max-width: 200px; max-height: 200px; margin-left: 30px;" src="../noticias/<?php echo $imagen; ?>">
									</div>
			    					<div class="form-group">
			    						<input type="hidden" name="noticia-id-editar" value="<?php echo $_POST['noticia-id-editar']; ?>">
			    						<span class="control-label">Cambiar imagen *</span>
										<input type="hidden" name="MAX_FILE_SIZE" value="16777216" />
										<input type="file" name="noticia-imagen-editar" accept=".jpg, .png, .jpeg, .gif" required="">
										<div class="input-group">
											<input type="text" readonly="" class="form-control" placeholder="Elija la imágen...">
											<span class="input-group-btn input-group-sm">
												<button type="button" class="btn btn-fab btn-fab-mini">
													<i class="zmdi zmdi-attachment-alt"></i>
												</button>
											</span>
										</div>
										<span><small>Tamaño máximo de los archivos adjuntos 2MB. Tipos de archivos permitidos imágenes: PNG, JPEG, JPG y GIF</small></span>
									</div>
			    				</div>
							</fieldset>
					    	<br>
					    	</fieldset>
						    <p class="text-center" style="margin-top: 20px;">
						    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
						    </p>
						    <div class="RespuestaAjax"></div>
					    </form>
				<?php else: ?>
					<p>Ha ocurrido un error al intentar cargar la información de esta noticia</p>
		    	<a href="<?php echo SERVERURL.'noticias/' ?>" class="btn btn-sm btn-info btn-raised">Regresar al listado de noticias</a>
				<?php endif ?>
		    <?php else: ?>
		    	<p>No ha seleccionado ninguna noticia para editar</p>
		    	<a href="<?php echo SERVERURL.'noticias/' ?>" class="btn btn-sm btn-info btn-raised">Regresar al listado de noticias</a>
		    <?php endif ?>
		</div>
	</div>
</div>
<script src="../vistas/js/ckeditor/ckeditor.js"></script>
<script>
	var editor = CKEDITOR.replace('noticia-contenido-editar', {language: 'es', height: '300px'});
	editor.on( 'change', function( evt )
	{
		CKEDITOR.instances['noticia-contenido-editar'].updateElement();
	});
</script>