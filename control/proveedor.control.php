<?php  


require_once "model/Proveedor.Model.php";
/**
 * 
 */

class ControladorProveedores
{
	/*=============================================
					MOSTRAR Proveedores
	=============================================*/
	static public function ctrMostrarProveedores()
	{
		
		$oProveedor_Model = new Proveedor_Model;

        $respuesta = $oProveedor_Model->GetProveedorList();

        return $respuesta;
	}

	/*=============================================
					CREAR PROVEEDOR
	=============================================*/
	static public function ctrCrearProveedor()
	{
		if (isset($_POST["nuevoRazonSocial"])) 
		{
			$TelFijo = intval(preg_replace('/[^0-9]+/', '', $_POST["nuevoTelFijo"]));
			$TelCelular = intval(preg_replace('/[^0-9]+/', '', $_POST["nuevoTelCelular"]));

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["nuevoRazonSocial"])&&
				preg_match('/^[0-9]+$/', $_POST["nuevoNit"])&&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["nuevoContacto"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["nuevoCargo"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#. ]+$/', $_POST["nuevoDireccion"])&&
				preg_match('/^[0-9]+$/', $TelFijo )&&
				preg_match('/^[0-9]+$/', $TelCelular)&&
				preg_match('/^[a-zA-Z0-9@.]+$/', $_POST["nuevoCorreo"])&&
				preg_match('/^(http|https):\\/\\/[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i', $_POST["nuevoWeb"])) 
			{

				$oProveedor_Model = new Proveedor_Model;
				$osProveedor = new Structure_Proveedor;

				$verificar = $oProveedor_Model->VerificarProveedor(Null,$_POST["nuevoRazonSocial"],$_POST["nuevoNit"]);

				if ($verificar == false) 
				{
					$osProveedor->idProveedor->SetValue(0);
					$osProveedor->hash->SetValue("");
					$osProveedor->razon_social->SetValue($_POST["nuevoRazonSocial"]);
					$osProveedor->nit->SetValue($_POST["nuevoNit"]);
					$osProveedor->contacto->SetValue($_POST["nuevoContacto"]);
					$osProveedor->cargo_contacto->SetValue($_POST["nuevoCargo"]);
					$osProveedor->direccion->SetValue($_POST["nuevoDireccion"]);
					$osProveedor->tel_fijo->SetValue($TelFijo);
					$osProveedor->tel_celular->SetValue($TelCelular);
					$osProveedor->correo->SetValue($_POST["nuevoCorreo"]);
					$osProveedor->web->SetValue($_POST["nuevoWeb"]);
					$osProveedor->estado->SetValue("Activo");

					$res = $oProveedor_Model->SaveProveedor($osProveedor);

					if ($res == true) 
					{
						echo '<script>

						swal({

							type: "success",
							title: "¡El proveedor ha sido guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "proveedores";

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
								
									window.location = "proveedores";

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
								title: "¡La Razón Social y/o el Nit ya se encuentran registrado. Verifique la información!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "proveedores";

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
 							title: "Los campos no pueden ir vacios o llevar caracteres especiales exeptos(@, ., #)",
 							showConfirmButton: true,
 							confirmButtonText: "Cerrar",
 							closeOnConfirm: false

 							}).then((result)=>{

 								if(result.value){

 									windows.location = "proveedores";
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
					MODIFICAR PROVEEDOR
	=============================================*/
	static public function ctrEditarProveedor()
	{
		if (isset($_POST["editarRazonSocial"])) 
		{
			$TelFijo = intval(preg_replace('/[^0-9]+/', '', $_POST["editarTelFijo"]));
			$TelCelular = intval(preg_replace('/[^0-9]+/', '', $_POST["editarTelCelular"]));

			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editaridProveedor"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["editarRazonSocial"])&&
				preg_match('/^[0-9]+$/', $_POST["editarNit"])&&
				preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["editarContacto"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["editarCargo"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#. ]+$/', $_POST["editarDireccion"])&&
				preg_match('/^[0-9]+$/', $TelFijo )&&
				preg_match('/^[0-9]+$/', $TelCelular)&&
				preg_match('/^[a-zA-Z0-9@.]+$/', $_POST["editarCorreo"])&&
				preg_match('/^(http|https):\\/\\/[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i', $_POST["editarWeb"])) 
			{

				$oProveedor_Model = new Proveedor_Model;
				$osProveedor = new Structure_Proveedor;

				$verificar = $oProveedor_Model->VerificarProveedor($_POST["editaridProveedor"],$_POST["editarRazonSocial"],$_POST["editarNit"]);

				if ($verificar == false) 
				{
					$osProveedor->idProveedor->SetValue(0);
					$osProveedor->hash->SetValue($_POST["editaridProveedor"]);
					$osProveedor->razon_social->SetValue($_POST["editarRazonSocial"]);
					$osProveedor->nit->SetValue($_POST["editarNit"]);
					$osProveedor->contacto->SetValue($_POST["editarContacto"]);
					$osProveedor->cargo_contacto->SetValue($_POST["editarCargo"]);
					$osProveedor->direccion->SetValue($_POST["editarDireccion"]);
					$osProveedor->tel_fijo->SetValue($TelFijo);
					$osProveedor->tel_celular->SetValue($TelCelular);
					$osProveedor->correo->SetValue($_POST["editarCorreo"]);
					$osProveedor->web->SetValue($_POST["editarWeb"]);
					$osProveedor->estado->SetValue("Activo");

					$res = $oProveedor_Model->UpdateProveedor($osProveedor);

					if ($res == true) 
					{
						echo '<script>

						swal({

							type: "success",
							title: "¡El proveedor ha sido modificado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "proveedores";

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
								
									window.location = "proveedores";

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
								title: "¡La Razón Social y/o el Nit ya se encuentran registrado. Verifique la información!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "proveedores";

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
 							title: "Los campos no pueden ir vacios o llevar caracteres especiales exeptos(@, ., #)",
 							showConfirmButton: true,
 							confirmButtonText: "Cerrar",
 							closeOnConfirm: false

 							}).then((result)=>{

 								if(result.value){

 									windows.location = "proveedores";
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
					ELIMINAR PROVEEDOR
	=============================================*/

	static public function ctrEliminarProveedor()
	{
		if (isset($_POST["eliminaridProveedor"])) 
		{
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["eliminaridProveedor"])) 
			{
				$oProveedor_Model = new Proveedor_Model;

				$res = $oProveedor_Model->DeleteProveedor($_POST["eliminaridProveedor"]);

				if ($res) 
				{
					echo '<script>

						swal({

							type: "success",
							title: "¡El proveedor se ha dado de baja correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "proveedores";

							}

						});
					

						</script>';
				}
				else
				{
					echo '<script>

						swal({

							type: "error",
							title: "¡El id no corresponde a un Proveedor!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "proveedores";

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

 									windows.location = "proveedores";
 								}


 							});

 					</script>
 				';
			}
		}
	}

	/*=============================================
					ACTIVAR PROVEEDOR
	=============================================*/

	static public function ctrActivarProveedor()
	{
		if (isset($_POST["activaridProveedor"])) 
		{
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["activaridProveedor"])) 
			{
				$oProveedor_Model = new Proveedor_Model;

				$res = $oProveedor_Model->ActiveProveedor($_POST["activaridProveedor"]);

				if ($res) 
				{
					echo '<script>

						swal({

							type: "success",
							title: "¡El Proveedor se Activado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "proveedores";

							}

						});
					

						</script>';
				}
				else
				{
					echo '<script>

						swal({

							type: "error",
							title: "¡El id no corresponde a un Proveedor!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "proveedores";

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

 									windows.location = "proveedores";
 								}


 							});

 					</script>
 				';
			}
		}
	}


}

?>