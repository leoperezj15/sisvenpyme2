<?php

require_once "../control/empleado.control.php";
require_once "../model/Empleado.Modelo.php";

class AjaxEmpleado{

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/	

	public $idEmpleado;

	public function ajaxEditarEmpleado(){

		$valor = $this->idEmpleado;

		$respuesta = ControladorEmpleados::ctrMostrarEmpleado($valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR EMPLEADO
	=============================================*/	

	public $ajaxActivarEmpleado;
	public $activarId;


	public function ajaxActivarEmpleado(){

		$tabla = "empleado";

		$item1 = "estado";
		$valor1 = $this->activarUsuario;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarUsuario;

	public function ajaxValidarEmpleado(){

		$item = "usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR EMPLEADO DISPARADOR
=============================================*/
if(isset($_POST["idEmpleado"])){

	$editar = new AjaxEmpleado();
	$editar->idEmpleado = $_POST["idEmpleado"];
	$editar->ajaxEditarEmpleado();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["validarUsuario"])){

	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();

}