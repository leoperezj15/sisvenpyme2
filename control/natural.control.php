<?php  


require_once "model/Natural.Model.php";
require_once "model/Cliente.Model.php";
require_once "model/data/transaction.inc";
/**
 * 
 */

class ControladorNatural
{
	/*=============================================
					MOSTRAR NATURAL
	=============================================*/
	static public function ctrMostrarClienteNatural()
	{
		
		$oNatural_Model = new Natural_Model;

        $respuesta = $oNatural_Model->GetListNatural();

        return $respuesta;
	}

	/*=============================================
					CREAR CLIENTE NATURAL
	=============================================*/
	static public function ctrCrearClienteNatural()
	{
		if (isset($_POST["nuevoNombre"])) 
		{
			$TelFijo = intval(preg_replace('/[^0-9]+/', '', $_POST["nuevoTelFijo"]));
			$TelCelular = intval(preg_replace('/[^0-9]+/', '', $_POST["nuevoTelCelular"]));
			$ci = intval(preg_replace('/[^0-9]+/', '', $_POST["nuevoCi"]));

			$validar_fecha = explode("/",$_POST["nuevoFechaNac"]);

			$fecha_valida = "".$validar_fecha[2]."-".$validar_fecha[1]."-".$validar_fecha[0]."";

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApPaterno"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApMaterno"])&&
				preg_match('/^[0-9]+$/', $ci)&&
				count($validar_fecha) == 3 && 
				checkdate($validar_fecha[1], $validar_fecha[0], $validar_fecha[2])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.# ]+$/', $_POST["nuevoDireccion"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoZona"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoGenero"])
			)//count($validar_fecha) == 3 && checkdate($validar_fecha[1], $validar_fecha[0], $validar_fecha[2])&&
			{

				/* INSTANCIA A LOS MODELOS */
				$oNatural_Model = new Natural_Model;
				$osNatural = new Structure_Natural;

				/* INSTANCIA A LOS MODELOS */
				$oCliente_Model = new Cliente_Model;
				$osCliente = new Structure_Cliente;

				/* INSTANCIA A CONF de TRANSACCIONES SQL */
				$oTransaction = new transaction;
				$oTransaction->StartTransaction();

				$verificar = $oNatural_Model->VerificarCI($_POST["nuevoCi"]);

				if ($verificar == false) 
				{
					$osCliente->idCliente->SetValue(0);
					$osCliente->hash->SetValue("");
					$osCliente->direccion->SetValue($_POST["nuevoDireccion"]);
					$osCliente->zona->SetValue($_POST["nuevoZona"]);
					$osCliente->tel_fijo->SetValue($_POST["nuevoTelFijo"]);
					$osCliente->tel_celular->SetValue($_POST["nuevoTelCelular"]);
					$osCliente->fecha_reg->SetValue(date("Y-m-d H:i:s"));
					$osCliente->estado->SetValue("Activo");

					$idClienteNew = $oCliente_Model->SaveCliente($osCliente);
					
					$osNatural->idCliente->SetValue($idClienteNew);
					$osNatural->nombre->SetValue($_POST["nuevoNombre"]);
					$osNatural->ap_paterno->SetValue($_POST["nuevoApPaterno"]);
					$osNatural->ap_materno->SetValue($_POST["nuevoApMaterno"]);
					$osNatural->fecha_nac->SetValue($fecha_valida);
					$osNatural->ci->SetValue($ci);
					$osNatural->genero->SetValue($_POST["nuevoGenero"]);

					$res = $oNatural_Model->SaveNatural($osNatural);

					if ( $idClienteNew != false and $res != false)
					{
						$oTransaction->Commit();
					}else
					{
						$oTransaction->Rollback();
					}

					if ($res == true) 
					{
						echo '<script>

						swal({

							type: "success",
							title: "¡El Cliente ha sido guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "natural";

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
								
									window.location = "natural";

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
								title: "¡Ya existe un Cliente con este Nro de CI. Verifique la información!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "natural";

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
 							title: "Los campos no pueden ir vacios o llevar caracteres especiales ó la fecha no es válida",
 							showConfirmButton: true,
 							confirmButtonText: "Cerrar",
 							closeOnConfirm: false

 							}).then((result)=>{

 								if(result.value){

 									windows.location = "natural";
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
					MODIFICAR CLIENTE NATURAL
	=============================================*/
	static public function ctrEditarClienteNatural()
	{
		if (isset($_POST["editarNombre"])) 
		{
			$TelFijo = intval(preg_replace('/[^0-9]+/', '', $_POST["editarTelFijo"]));
			$TelCelular = intval(preg_replace('/[^0-9]+/', '', $_POST["editarTelCelular"]));
			$ci = intval(preg_replace('/[^0-9]+/', '', $_POST["editarCi"]));

			$validar_fecha = explode("/",$_POST["editarFechaNac"]);

			$fecha_valida = "".$validar_fecha[2]."-".$validar_fecha[1]."-".$validar_fecha[0]."";

			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editaridCliente"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApPaterno"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApMaterno"])&&
				preg_match('/^[0-9]+$/', $ci)&&
				count($validar_fecha) == 3 && 
				checkdate($validar_fecha[1], $validar_fecha[0], $validar_fecha[2])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.# ]+$/', $_POST["editarDireccion"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarZona"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarGenero"])
			)//count($validar_fecha) == 3 && checkdate($validar_fecha[1], $validar_fecha[0], $validar_fecha[2])&&
			{
				/* INSTANCIA A LOS MODELOS */
				$oNatural_Model = new Natural_Model;
				$osNatural = new Structure_Natural;

				/* INSTANCIA A LOS MODELOS */
				$oCliente_Model = new CLiente_Model;
				$osCliente = new Structure_Cliente;

				/* INSTANCIA A CONF de TRANSACCIONES SQL */
				$oTransaction = new transaction;
				$oTransaction->StartTransaction();

				$verificar = $oNatural_Model->VerificarCI($_POST["editarCi"]);

				if ($verificar == true) 
				{
					$osCliente->idCliente->SetValue(0);
					$osCliente->hash->SetValue($_POST["editaridCliente"]);
					$osCliente->direccion->SetValue($_POST["editarDireccion"]);
					$osCliente->zona->SetValue($_POST["editarZona"]);
					$osCliente->tel_fijo->SetValue($_POST["editarTelFijo"]);
					$osCliente->tel_celular->SetValue($_POST["editarTelCelular"]);
					$osCliente->estado->SetValue("Activo");

					$idCliente = $oCliente_Model->UpdateCliente($osCliente);
					
					$osNatural->idCliente->SetValue($idCliente);
					$osNatural->nombre->SetValue($_POST["editarNombre"]);
					$osNatural->ap_paterno->SetValue($_POST["editarApPaterno"]);
					$osNatural->ap_materno->SetValue($_POST["editarApMaterno"]);
					$osNatural->fecha_nac->SetValue($fecha_valida);
					$osNatural->ci->SetValue($_POST["editarCi"]);
					$osNatural->genero->SetValue($_POST["editarGenero"]);

					$res = $oNatural_Model->UpdateNatural($osNatural);

					if ( $idCliente != false and $res != false)
					{
						$oTransaction->Commit();
					}else
					{
						$oTransaction->Rollback();
					}

					if ($res == true) 
					{
						echo '<script>

						swal({

							type: "success",
							title: "¡El Cliente ha sido modificado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "natural";

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
								
									window.location = "natural";

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
								title: "¡El Cliente no existe con este Nro de CI. Verifique la información!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "natural";

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
 							title: "Los campos no pueden ir vacios o llevar caracteres especiales ó la fecha no es válida",
 							showConfirmButton: true,
 							confirmButtonText: "Cerrar",
 							closeOnConfirm: false

 							}).then((result)=>{

 								if(result.value){

 									windows.location = "natural";
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
					DESACTIVAR CLIENTE NATURAL
	=============================================*/

	static public function ctrEliminarClienteNatural()
	{
		if (isset($_POST["eliminaridCliente"])) 
		{
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["eliminaridCliente"])) 
			{
				$oCliente_Model = new Cliente_Model;

				$res = $oCliente_Model->DeleteCliente($_POST["eliminaridCliente"]);

				if ($res) 
				{
					echo '<script>

						swal({

							type: "success",
							title: "¡El Cliente se ah dado de baja correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "natural";

							}

						});
					

						</script>';
				}
				else
				{
					echo '<script>

						swal({

							type: "error",
							title: "¡El id no corresponde a un Cliente Válido!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "natural";

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

 									windows.location = "natural";
 								}


 							});

 					</script>
 				';
			}
		}
	}

	/*=============================================
					ACTIVAR CLIENTE NATURAL
	=============================================*/

	static public function ctrActivarClienteNatural()
	{
		if (isset($_POST["activaridCliente"])) 
		{
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["activaridCliente"])) 
			{
				$oCliente_Model = new Cliente_Model;

				$res = $oCliente_Model->ActiveCliente($_POST["activaridCliente"]);

				if ($res) 
				{
					echo '<script>

						swal({

							type: "success",
							title: "¡El Cliente ha sido Activado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "natural";
								Pace.stop();

							}

						});
					

						</script>';
				}
				else
				{
					echo '<script>

						swal({

							type: "error",
							title: "¡El id no corresponde a un Cliente Válido!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "natural";

							}
							window.location = "natural";


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

 									windows.location = "natural";
 								}


 							});

 					</script>
 				';
			}
		}
	}

}

?>