<?php
	$peticionAjax=true;
	require_once "../core/configGeneral.php";
	if(isset($_POST['noticia-titulo-nueva']) && isset($_POST['noticia-contenido-nueva']) && isset($_FILES['noticia-imagen-nueva']))
	{
		require_once "../controladores/administradorControlador.php";
		$insAdmin = new administradorControlador();
		echo $insAdmin->agregar_noticia_controlador();
	}
	elseif(isset($_POST['noticia-id-editar']) && isset($_POST['noticia-titulo-editar']) && isset($_POST['noticia-contenido-editar']))
	{
		require_once "../controladores/administradorControlador.php";
		$insAdmin = new administradorControlador();
		echo $insAdmin->editar_noticia_controlador();
	}
	elseif(isset($_POST['noticia-id-editar']) && isset($_FILES['noticia-imagen-editar']))
	{
		require_once "../controladores/administradorControlador.php";
		$insAdmin = new administradorControlador();
		echo $insAdmin->editar_noticia_imagen_controlador();
	}
	elseif(isset($_POST['noticia-id-eliminar']))
	{
		require_once "../controladores/administradorControlador.php";
		$insAdmin = new administradorControlador();
		echo $insAdmin->eliminar_noticia_controlador();
	}