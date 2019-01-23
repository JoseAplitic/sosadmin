<?php
	$peticionAjax=true;
	require_once "../core/configGeneral.php";
	if(isset($_POST['usuario-nombre-nuevo']) && isset($_POST['usuario-apellido-nuevo']) && isset($_POST['usuario-usuario-nuevo']) && isset($_POST['usuario-correo-nuevo']) && isset($_POST['usuario-contra1-nuevo']) && isset($_POST['usuario-contra2-nuevo']))
	{
		require_once "../controladores/administradorControlador.php";
		$insAdmin = new administradorControlador();
		echo $insAdmin->agregar_administrador_controlador();
	}
	elseif(isset($_POST['usuario-id-editar']) && isset($_POST['usuario-nombre-editar']) && isset($_POST['usuario-apellido-editar']) && isset($_POST['usuario-usuario-editar']) && isset($_POST['usuario-correo-editar']) && isset($_POST['usuario-contra1-editar']) && isset($_POST['usuario-contra2-editar']))
	{
		require_once "../controladores/administradorControlador.php";
		$insAdmin = new administradorControlador();
		echo $insAdmin->editar_administrador_controlador();
	}
	elseif(isset($_POST['usuario-id-editar-perfil']) && isset($_POST['usuario-nombre-editar-perfil']) && isset($_POST['usuario-apellido-editar-perfil']) && isset($_POST['usuario-usuario-editar-perfil']) && isset($_POST['usuario-correo-editar-perfil']) && isset($_POST['usuario-contra1-editar-perfil']) && isset($_POST['usuario-contra2-editar-perfil']))
	{
		require_once "../controladores/administradorControlador.php";
		$insAdmin = new administradorControlador();
		echo $insAdmin->editar_perfil_controlador();
	}
	elseif(isset($_POST['usuario-id-eliminar']))
	{
		require_once "../controladores/administradorControlador.php";
		$insAdmin = new administradorControlador();
		echo $insAdmin->eliminar_administrador_controlador();
	}
	elseif(isset($_POST['categoria-nombre-nueva']) && isset($_POST['categoria-slug-nueva']) && isset($_POST['categoria-descripcion-nueva']) && isset($_POST['categoria-padre-nueva']) && isset($_POST['categoria-icono-nueva']))
	{
		require_once "../controladores/administradorControlador.php";
		$insAdmin = new administradorControlador();
		echo $insAdmin->agregar_categoria_controlador();
	}
	elseif(isset($_POST['categoria-id-eliminar']))
	{
		require_once "../controladores/administradorControlador.php";
		$insAdmin = new administradorControlador();
		echo $insAdmin->eliminar_categoria_controlador();
	}
	elseif(isset($_POST['categoria-id-editar']) && isset($_POST['categoria-nombre-editar']) && isset($_POST['categoria-slug-editar']) && isset($_POST['categoria-descripcion-editar']) && isset($_POST['categoria-padre-editar']) && isset($_POST['categoria-icono-editar']))
	{
		require_once "../controladores/administradorControlador.php";
		$insAdmin = new administradorControlador();
		echo $insAdmin->editar_categoria_controlador();
	}
	else
	{
		session_start(['name'=>'adminsoswebstore']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/" </script>';
	}