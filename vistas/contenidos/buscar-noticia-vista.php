<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Buscar <small>NOTICIAS</small></h1>
	</div>
	<p class="lead">Ingresa tu busqueda, puedes buscar noticias por titulo, por su contenido o por la fecha en la cual fue agregada</p>
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

	if(isset($_POST['busqueda_inicial_noticia'])){
		$_SESSION['busqueda_noticia']=$_POST['busqueda_inicial_noticia'];
	}

	if(isset($_POST['eliminar_busqueda_noticia'])){
		unset($_SESSION['busqueda_noticia']);
	}

	if(!isset($_SESSION['busqueda_noticia']) && empty($_SESSION['busqueda_noticia'])):
?>
<div class="container-fluid">
	<form class="well" method="POST" action="" autocomplete="off">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="form-group label-floating">
					<span class="control-label">¿A quién estas buscando?</span>
					<input class="form-control" type="text" name="busqueda_inicial_noticia" required="">
				</div>
			</div>
			<div class="col-xs-12">
				<p class="text-center">
					<button type="submit" class="btn btn-primary btn-raised btn-sm"><i class="zmdi zmdi-search"></i> &nbsp; Buscar</button>
				</p>
			</div>
		</div>
	</form>
</div>
<?php else: ?>
<div class="container-fluid">
	<form class="well" method="POST" action="">
		<p class="lead text-center">Su última búsqueda  fue <strong>“<?php echo $_SESSION['busqueda_noticia']; ?>”</strong></p>
		<div class="row">
			<input class="form-control" type="hidden" name="eliminar_busqueda_noticia" value="1">
			<div class="col-xs-12">
				<p class="text-center">
					<button type="submit" class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-delete"></i> &nbsp; Eliminar búsqueda</button>
				</p>
			</div>
		</div>
	</form>
</div>

<!-- Panel listado de busqueda de administradores -->
<div class="container-fluid">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-search"></i> &nbsp; BUSCAR ADMINISTRADOR</h3>
		</div>
		<div class="panel-body">
			<?php 
				$pagina = explode("/", $_GET['views']);
				echo $insAdmin->paginador_noticias_controlador($pagina[1],10,$_SESSION['busqueda_noticia']);
			?>
		</div>
	</div>
</div>
<?php endif; ?>