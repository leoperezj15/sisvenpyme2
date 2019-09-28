<?php  


require_once "model/Juridico.Model.php";
require_once "model/Cliente.Model.php";
require_once "model/data/transaction.inc";
/**
 * 
 */

class ControladorJuridico
{
	/*=============================================
					MOSTRAR JURIDICO
	=============================================*/
	static public function ctrMostrarClienteJuridico()
	{
		
		$oJuridico_Model = new Juridico_Model;

        $respuesta = $oJuridico_Model->GetListClienteJuridico();

        return $respuesta;
	}

	/*=============================================
					CREAR CLIENTE JURIDICO
	=============================================*/

	static public function ctrCrearClienteJuridico()
	{
		if (isset($_POST["nuevoRazonSocial"])) 
		{
			$TelFijo = intval(preg_replace('/[^0-9]+/', '', $_POST["nuevoTelFijo"]));
			$TelCelular = intval(preg_replace('/[^0-9]+/', '', $_POST["nuevoTelCelular"]));

			if (is_numeric($_POST["nuevoNit"])) 
			{
				$nit = $_POST["nuevoNit"];
			}
			else
			{
				$nit = intval(preg_replace('/[^0-9]+/', '', $_POST["nuevoNit"]));
			}
			

			// echo '<pre>';
			// print_r($_POST["nuevoNit"]."  ".$nit);
			// echo '</pre>';

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["nuevoRazonSocial"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoRpteLegal"])&&
				preg_match('/^[0-9]+$/', $nit)&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.# ]+$/', $_POST["nuevoDireccion"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoZona"])
				)//count($validar_fecha) == 3 && checkdate($validar_fecha[1], $validar_fecha[0], $validar_fecha[2])&&
			{

				/* INSTANCIA A LOS MODELOS */
				$oJuridico_Model = new Juridico_Model;
				$osJuridico = new Structure_Juridico;

				/* INSTANCIA A LOS MODELOS */
				$oCliente_Model = new CLiente_Model;
				$osCliente = new Structure_Cliente;

				/* INSTANCIA A CONF de TRANSACCIONES SQL */
				$oTransaction = new transaction;
				$oTransaction->StartTransaction();

				$verificar = $oJuridico_Model->VerificarNit($nit);

				if ($verificar == false) 
				{
					$osCliente->idCliente->SetValue(0);
					$osCliente->hash->SetValue("");
					$osCliente->direccion->SetValue($_POST["nuevoDireccion"]);
					$osCliente->zona->SetValue($_POST["nuevoZona"]);
					$osCliente->tel_fijo->SetValue($TelFijo);
					$osCliente->tel_celular->SetValue($TelCelular);
					$osCliente->estado->SetValue("Activo");

					$idClienteNew = $oCliente_Model->SaveCliente($osCliente);
					
					$osJuridico->idCliente->SetValue($idClienteNew);
					$osJuridico->razon_social->SetValue($_POST["nuevoRazonSocial"]);
					$osJuridico->rpte_legal->SetValue($_POST["nuevoRpteLegal"]);
					$osJuridico->nit->SetValue($nit);

					$res = $oJuridico_Model->SaveJuridico($osJuridico);

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
							
								window.location = "juridico";

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
								
									window.location = "juridico";

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
								title: "¡Ya existe un Cliente con este Nro de NIT. Verifique la información!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "juridico";

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

 									windows.location = "juridico";
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
					MODIFICAR CLIENTE JURIDICO
	=============================================*/
	static public function ctrEditarClienteJuridico()
	{
		if (isset($_POST["editarRazonSocial"])) 
		{
			$TelFijo = intval(preg_replace('/[^0-9]+/', '', $_POST["editarTelFijo"]));
			$TelCelular = intval(preg_replace('/[^0-9]+/', '', $_POST["editarTelCelular"]));
			if (is_numeric($_POST["editarNit"])) 
			{
				$nit = $_POST["editarNit"];
			}
			else
			{
				$nit = intval(preg_replace('/[^0-9]+/', '', $_POST["editarNit"]));
			}

			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editaridCliente"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["editarRazonSocial"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarRpteLegal"])&&
				preg_match('/^[0-9]+$/', $nit)&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.#, ]+$/', $_POST["editarDireccion"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarZona"])
			)
				//count($validar_fecha) == 3 && checkdate($validar_fecha[1], $validar_fecha[0], $validar_fecha[2])&&
			{

				/* INSTANCIA A LOS MODELOS */
				$oJuridico_Model = new Juridico_Model;
				$osJuridico = new Structure_Juridico;

				/* INSTANCIA A LOS MODELOS */
				$oCliente_Model = new CLiente_Model;
				$osCliente = new Structure_Cliente;

				/* INSTANCIA A CONF de TRANSACCIONES SQL */
				$oTransaction = new transaction;
				$oTransaction->StartTransaction();

				$verificar = $oJuridico_Model->VerificarNit($nit);

				if ($verificar == true) 
				{
					$osCliente->idCliente->SetValue(0);
					$osCliente->hash->SetValue($_POST["editaridCliente"]);
					$osCliente->direccion->SetValue($_POST["editarDireccion"]);
					$osCliente->zona->SetValue($_POST["editarZona"]);
					$osCliente->tel_fijo->SetValue($TelFijo);
					$osCliente->tel_celular->SetValue($TelCelular);
					$osCliente->estado->SetValue("Activo");

					$idCliente = $oCliente_Model->UpdateCliente($osCliente);
					
					$osJuridico->idCliente->SetValue($idCliente);
					$osJuridico->razon_social->SetValue($_POST["editarRazonSocial"]);
					$osJuridico->rpte_legal->SetValue($_POST["editarRpteLegal"]);
					$osJuridico->nit->SetValue($nit);

					$res = $oJuridico_Model->UpdateJuridico($osJuridico);

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
							
								window.location = "juridico";

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
								
									window.location = "juridico";

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
								title: "¡Ya existe un Cliente con este Nro de NIT. Verifique la información!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "juridico";

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

 									windows.location = "juridico";
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
					DESACTIVAR CLIENTE JURIDICO
	=============================================*/

	static public function ctrEliminarClienteJuridico()
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
							
								window.location = "juridico";

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
							
								window.location = "juridico";

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

 									windows.location = "juridico";
 								}


 							});

 					</script>
 				';
			}
		}
	}

	/*=============================================
					ACTIVAR CLIENTE JURIDICO
	=============================================*/

	static public function ctrActivarClienteJuridico()
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
							
								window.location = "juridico";

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
							
								window.location = "juridico";

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

 									windows.location = "juridico";
 								}


 							});

 					</script>
 				';
			}
		}
	}

}

?>