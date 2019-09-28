<?php  

require_once "model/Almacen.Model.php";
require_once "model/Sucursal.Model.php";
/**
 * 
 */

class ControladorSucursal
{
	/*=============================================
					MOSTRAR SUCURSALES
	=============================================*/
	static public function ctrMostrarSucursales()
	{
		
		$oSucursal_Model = new Sucursal_Model;

        $respuesta = $oSucursal_Model->GetSucursalList();

        return $respuesta;
	}

	/*=============================================
					MOSTRAR UN Almacen
	=============================================*/
	static public function ctrMostrarAlmacen($_hash)
	{
		
		$oAlmacen_Model = new Almacen_Model;

        $respuesta = $oAlmacen_Model->GetDataAlmacen($_hash);

        return $respuesta;
	}

	/*=============================================
					CREAR SUCURSAL
	=============================================*/
	static public function ctrCrearSucursal()
	{
		if (isset($_POST["nuevoNombre"])) 
		{
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoUbicacion"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripcion"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#. ]+$/', $_POST["nuevoDireccion"])) 
			{

				$oSucursal_Model = new Sucursal_Model;
				$osSucursal = new Structure_Sucursal;

				$verificar = $oSucursal_Model->VerificarSucursal($_POST["nuevoNombre"],null);

				if ($verificar == false) 
				{
					$osSucursal->idSucursal->SetValue(0);
					$osSucursal->hash->SetValue("");
					$osSucursal->Nombre->SetValue($_POST["nuevoNombre"]);
					$osSucursal->Ubicacion->SetValue($_POST["nuevoUbicacion"]);
					$osSucursal->Descripcion->SetValue($_POST["nuevoDescripcion"]);
					$osSucursal->Direccion->SetValue($_POST["nuevoDireccion"]);
					$osSucursal->estado->SetValue("Activo");

					$res = $oSucursal_Model->SaveSucursal($osSucursal);

					$algo = array($osSucursal );

					$_SESSION["Prueba"] = $algo;

					if ($res == true) 
					{
						echo '<script>

						swal({

							type: "success",
							title: "¡La Sucursal ha sido guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "sucursales";

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
								
									window.location = "sucursales";

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
								title: "¡Este nombre ya se encuentran registrado. Verifique la información!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "sucursales";

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
 							title: "Los campos no pueden ir vacios o llevar caracteres especiales",
 							showConfirmButton: true,
 							confirmButtonText: "Cerrar",
 							closeOnConfirm: false

 							}).then((result)=>{

 								if(result.value){

 									windows.location = "sucursales";
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
					MODIFICAR SUCURSAL
	=============================================*/
	static public function ctrEditarSucursal()
	{
		if (isset($_POST["editarNombre"])) 
		{
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarUbicacion"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ#. ]+$/', $_POST["editarDireccion"])&&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["editaridSucursal"])) 
			{

				$oSucursal_Model = new Sucursal_Model;
				$osSucursal = new Structure_Sucursal;

				$verificar = $oSucursal_Model->VerificarSucursal($_POST["editarNombre"],$_POST["editaridSucursal"]);

				if ($verificar == false) 
				{
					$osSucursal->idSucursal->SetValue(0);
					$osSucursal->hash->SetValue($_POST["editaridSucursal"]);
					$osSucursal->Nombre->SetValue($_POST["editarNombre"]);
					$osSucursal->Ubicacion->SetValue($_POST["editarUbicacion"]);
					$osSucursal->Descripcion->SetValue($_POST["editarDescripcion"]);
					$osSucursal->Direccion->SetValue($_POST["editarDireccion"]);
					$osSucursal->estado->SetValue("Activo");

					$res = $oSucursal_Model->UpdateSucursal($osSucursal);

					if ($res == true) 
					{
						echo '<script>

						swal({

							type: "success",
							title: "¡La Sucursal ha sido modificado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "sucursales";

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
								
									window.location = "sucursales";

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
								title: "¡Este nombre ya se encuentran registrados. Verifique la información!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "sucursales";

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
 							title: "Los campos no pueden ir vacios o llevar caracteres especiales",
 							showConfirmButton: true,
 							confirmButtonText: "Cerrar",
 							closeOnConfirm: false

 							}).then((result)=>{

 								if(result.value){

 									windows.location = "sucursales";
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
					ELIMINAR SUCURSAL
	=============================================*/

	static public function ctrEliminarSucursal()
	{
		if (isset($_POST["eliminaridSucursal"])) 
		{
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["eliminaridSucursal"])) 
			{
				$oSucursal_Model = new Sucursal_Model;

				$res = $oSucursal_Model->DeleteSucursal($_POST["eliminaridSucursal"]);

				if ($res) 
				{
					echo '<script>

						swal({

							type: "success",
							title: "¡La Sucursal se ha dado de baja correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "sucursales";

							}

						});
					

						</script>';
				}
				else
				{
					echo '<script>

						swal({

							type: "error",
							title: "¡El id no corresponde a una Sucursal!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "sucursales";

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

 									windows.location = "sucursales";
 								}


 							});

 					</script>
 				';
			}
		}
	}

	/*=============================================
					ACTIVAR SUCURSAL
	=============================================*/

	static public function ctrActivarSucursal()
	{
		if (isset($_POST["activaridSucursal"])) 
		{
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["activaridSucursal"])) 
			{
				$oSucursal_Model = new Sucursal_Model;

				$res = $oSucursal_Model->ActiveSucursal($_POST["activaridSucursal"]);

				if ($res) 
				{
					echo '<script>

						swal({

							type: "success",
							title: "¡La Sucursal se Activado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "sucursales";

							}

						});
					

						</script>';
				}
				else
				{
					echo '<script>

						swal({

							type: "error",
							title: "¡El id no corresponde a una Sucursal!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "sucursales";

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

 									windows.location = "sucursales";
 								}


 							});

 					</script>
 				';
			}
		}
	}


}

?>