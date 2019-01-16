<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-file-add zmdi-hc-fw"></i> Noticias <small>AGREGAR</small></h1>
	</div>
	<p class="lead">Agregar noticias llenando los siguientes campos todos son requeridos para el proceso de publicación de una nueva noticia</p>
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
<!-- Panel nueva noticia -->
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVA NOTICIA</h3>
		</div>
		<div class="panel-body">
			<form action="<?php echo SERVERURL; ?>ajax/noticiaAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-collection-text"></i> &nbsp; Datos de la noticia</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Titulo *</label>
								  	<input class="form-control" type="text" name="noticia-titulo-nueva" required="" maxlength="200">
								</div>
		    				</div>
		    				<div class="col-xs-12">
								<div class="form-group label-floating">
								  	<label>Contenido *</label>
								  	<textarea name="noticia-contenido-nueva"></textarea>
								</div>
		    				</div>
		    			</div>
		    		</div>
		    	</fieldset>
		    	<br>
		    	<fieldset>
					<legend><i class="zmdi zmdi-image"></i> &nbsp; Imagen de la noticia</legend>
					<div class="col-xs-12">
    					<div class="form-group">
    						<span class="control-label">Imagen *</span>
							<input type="hidden" name="MAX_FILE_SIZE" value="16777216" />
							<input type="file" id="editortxt" name="noticia-imagen-nueva" accept=".jpg, .png, .jpeg, .gif" required="">
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
		</div>
	</div>
</div>
<script src="../vistas/js/ckeditor/ckeditor.js"></script>
<script>
	var editor = CKEDITOR.replace('noticia-contenido-nueva', {language: 'es', height: '300px'});
	editor.on( 'change', function( evt )
	{
		CKEDITOR.instances['noticia-contenido-nueva'].updateElement();
	});
</script>