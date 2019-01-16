<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-collection-text zmdi-hc-fw"></i> Noticias <small>INGRESADAS</small></h1>
	</div>
	<p class="lead">En esta sección puedes ver todas las noticias que se han registrado en este noticiero, puedes agregar, editar y eliminar noticias pero hazlo con responsabilidad.</p>
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
<!-- Panel listado de noticias -->
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE NOTICIAS</h3>
		</div>
		<div class="panel-body">
			<?php 
				$pagina = explode("/", $_GET['views']);
				echo $insAdmin->paginador_noticias_controlador($pagina[1],10,"");
			?>	
		</div>
	</div>
</div>