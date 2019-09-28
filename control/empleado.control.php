<?php  


require_once "model/Empleado.Model.php";
/**
 * 
 */

class ControladorEmpleados
{
	/*=============================================
					MOSTRAR EMPLEADOS
	=============================================*/
	static public function ctrMostrarEmpleados()
	{
		
		$oEmpleados_Model = new Empleados_Model;

        $respuesta = $oEmpleados_Model->GetListEmpleadoSU();

        return $respuesta;
	}

	/*=============================================
					MOSTRAR UN EMPLEADO
	=============================================*/
	static public function ctrMostrarEmpleado($_hash)
	{
		
		$oEmpleados_Model = new Empleados_Model;

        $respuesta = $oEmpleados_Model->GetDataEmpleado($_hash);

        return $respuesta;
	}

	/*=============================================
					CREAR EMPLEADOS
	=============================================*/
	static public function ctrCrearEmpleado()
	{
		if (isset($_POST["nuevoNombre"])) 
		{
			# nuevonombre, nuevoPaterno, nuevoMaterno, nuevaFecha, NuevoCI
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoPaterno"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoMaterno"])&&
				preg_match('/^[0-9]+$/', $_POST["nuevoCI"])) 
			{

				$oEmpleados_Model = new Empleados_Model;
				$osEmpleados = new Structure_Empleado;

				$verificarCI = $oEmpleados_Model->VerificarCI($_POST["nuevoCI"]);

				if ($verificarCI == false) 
				{
					$osEmpleados->idEmpleado->SetValue(0);
					$osEmpleados->hash->SetValue("");
					$osEmpleados->nombre->SetValue($_POST["nuevoNombre"]);
					$osEmpleados->apPaterno->SetValue($_POST["nuevoPaterno"]);
					$osEmpleados->apMaterno->SetValue($_POST["nuevoMaterno"]);
					$osEmpleados->fechaNacimiento->SetValue($_POST["nuevaFecha"]);
					$osEmpleados->ci->SetValue($_POST["nuevoCI"]);
					$osEmpleados->estado->SetValue("Activo");

					$res = $oEmpleados_Model->SaveEmpleado($osEmpleados);

					if ($res == true) 
					{
						echo '<script>

						swal({

							type: "success",
							title: "¡El empleado ha sido guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "empleados";

							}

						});
					

						</script>';


					}
					else
					{
						echo '<script>

							swal({

								type: "error",
								title: "¡No se pudo complentar la operación!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "empleados";

								}

							});
						

						</script>';
					}

				}
				else
				{
					echo '<script>

							swal({

								type: "error",
								title: "¡El CI del Empleado Corresponde a un empleado ya registrado. Verifique la información!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "empleados";

								}

							});
						

						</script>';
				}

				
		        //falta completar el campo de de la notificacion y confirmar guradado de los cambios
			}
			else
			{
 				echo '

 					<script>

 						swal({

 							type: "error",
 							title: "El nombre, ap Paterno y ap Materno no pueden ir vacios o llevar caracteres especiales",
 							showConfirmButton: true,
 							confirmButtonText: "Cerrar",
 							closeOnConfirm: false

 							}).then((result)=>{

 								if(result.value){

 									windows.location = "empleados";
 								}


 							});

 					</script>
 				';
			}
		}
		else
		{
			

		}

	}
	/*=============================================
					MODIFICAR EMPLEADOS
	=============================================*/
	static public function ctrEditarEmpleado()
	{
		if (isset($_POST["editarNombre"]))
		{
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarPaterno"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMaterno"])&&
				preg_match('/^[0-9]+$/', $_POST["editarCI"])) 
			{

				$oEmpleados_Model = new Empleados_Model;
				$osEmpleados = new Structure_Empleado;

				$verificarCI = $oEmpleados_Model->VerificarCI($_POST["editarCI"]);

				if ($verificarCI == true) 
				{
					$osEmpleados->idEmpleado->SetValue(0);
					$osEmpleados->hash->SetValue($_POST["editaridEmpleado"]);
					$osEmpleados->nombre->SetValue($_POST["editarNombre"]);
					$osEmpleados->apPaterno->SetValue($_POST["editarPaterno"]);
					$osEmpleados->apMaterno->SetValue($_POST["editarMaterno"]);
					$osEmpleados->fechaNacimiento->SetValue($_POST["editarFecha"]);
					$osEmpleados->ci->SetValue($_POST["editarCI"]);
					$osEmpleados->estado->SetValue("Activo");

					$res = $oEmpleados_Model->UpdateEmpleado($osEmpleados);

					if ($res == true) 
					{
						echo '<script>

						swal({

							type: "success",
							title: "¡El empleado ha sido modificado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "empleados";

							}

						});
					

						</script>';


					}
					else
					{
						echo '<script>

							swal({

								type: "error",
								title: "¡No se pudo complentar la operación, Contacte a soporte!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "empleados";

								}

							});
						

						</script>';
					}
				}
				else
				{
					echo '<script>

							swal({

								type: "error",
								title: "¡El CI no Corresponde a un empleado registrado. Verifique la información!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "empleados";

								}

							});
						

						</script>';
				}


			}
			else
			{
				echo '

 					<script>

 						swal({

 							type: "error",
 							title: "Los datos no pueden ir vacios o llevar caracteres especiales",
 							showConfirmButton: true,
 							confirmButtonText: "Cerrar",
 							closeOnConfirm: false

 							}).then((result)=>{

 								if(result.value){

 									windows.location = "empleados";
 								}


 							});

 					</script>
 				';
			}

		}
		else
		{

		}
	}

	/*=============================================
					ELIMINAR EMPLEADOS
	=============================================*/

	static public function ctrEliminarEmpleado()
	{
		if (isset($_POST["eliminaridEmpleado"])) 
		{
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["eliminaridEmpleado"])) 
			{
				$oEmpleados_Model = new Empleados_Model;

				$idEmpleado = $_POST["eliminaridEmpleado"];

				echo "<pre>";

				print_r($idEmpleado);

				echo "</pre>";

				$res = $oEmpleados_Model->DeleteEmpleado($idEmpleado);

				if ($res) 
				{
					echo '<script>

						swal({

							type: "success",
							title: "¡El empleado ha dado de baja correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "empleados";

							}

						});
					

						</script>';
				}
				else
				{
					echo '<script>

						swal({

							type: "error",
							title: "¡El id no corresponde a un empleado!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "empleados";

							}

						});
					

						</script>';
				}
	
			}
			else
			{
				echo '

 					<script>

 						swal({

 							type: "error",
 							title: "Los datos no pueden ir vacíos o llevar caracteres especiales",
 							showConfirmButton: true,
 							confirmButtonText: "Cerrar",
 							closeOnConfirm: false

 							}).then((result)=>{

 								if(result.value){

 									windows.location = "empleados";
 								}


 							});

 					</script>
 				';
			}
		}
	}

	/*=============================================
					ACTIVAR EMPLEADOS
	=============================================*/

	static public function ctrActivarEmpleado()
	{
		if (isset($_POST["activaridEmpleado"])) 
		{
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["activaridEmpleado"])) 
			{
				$oEmpleados_Model = new Empleados_Model;

				$idEmpleado = $_POST["activaridEmpleado"];

				echo "<pre>";

				print_r($idEmpleado);

				echo "</pre>";

				$res = $oEmpleados_Model->ActiveEmpleado($idEmpleado);

				if ($res) 
				{
					echo '<script>

						swal({

							type: "success",
							title: "¡El empleado ha Activado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "empleados";

							}

						});
					

						</script>';
				}
				else
				{
					echo '<script>

						swal({

							type: "error",
							title: "¡El id no corresponde a un empleado!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "empleados";

							}

						});
					

						</script>';
				}
	
			}
			else
			{
				echo '

 					<script>

 						swal({

 							type: "error",
 							title: "Los datos no pueden ir vacíos o llevar caracteres especiales",
 							showConfirmButton: true,
 							confirmButtonText: "Cerrar",
 							closeOnConfirm: false

 							}).then((result)=>{

 								if(result.value){

 									windows.location = "empleados";
 								}


 							});

 					</script>
 				';
			}
		}
	}


}

?>