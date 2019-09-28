<?php  

require_once "model/Almacen.Model.php";
require_once "model/Sucursal.Model.php";

/**
 * 
 */
class ControladorAlmacen
{
	/*=============================================
					MOSTRAR ALMACENES
	=============================================*/
	static public function ctrMostrarAlmacenes()
	{
		
		$oAlmacen_Model = new Almacen_Model;

        $respuesta = $oAlmacen_Model->GetAlmacenList();

        return $respuesta;
	}
	/*=============================================
					LISTAR ALMACEN POR SUCURSAL
	=============================================*/

	static public function ctrAlmacenPorSucursal($_idSucursal=1)
	{
		$oAlmacen_Model = new Almacen_Model;

		$respuesta = $oAlmacen_Model->listarAlmacenPorSucursal($_idSucursal);

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
					CREAR EMPLEADOS
	=============================================*/
	static public function ctrCrearAlmacen()
	{
		if (isset($_POST["nuevoNombre"])) 
		{
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoSigla"])&&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoSucursal"])) 
			{

				$oAlmacen_Model = new Almacen_Model;
				$oSucursal_Model = new Sucursal_Model;
				$osAlmacen = new Structure_Almacen;
				$osSucursal = new Structure_Sucursal;

				$verificar = $oAlmacen_Model->Verificar($_POST["nuevoNombre"],$_POST["nuevoSigla"]);

				if ($verificar == false) 
				{
					$sucursal = $oSucursal_Model->GetDataSucursal($_POST["nuevoSucursal"]);

					if ($sucursal != false) 
					{
						foreach ($sucursal as $key => $value) 
						{
							$idSucursal = $value->idSucursal->GetValue();
						}

						$osAlmacen->idAlmacen->SetValue(0);
						$osAlmacen->hash->SetValue("");
						$osAlmacen->Nombre->SetValue($_POST["nuevoNombre"]);
						$osAlmacen->Sigla->SetValue($_POST["nuevoSigla"]);
						$osAlmacen->idSucursal->SetValue($idSucursal);
						$osAlmacen->estado->SetValue("Activo");

						$res = $oAlmacen_Model->SaveAlmacen($osAlmacen);

						if ($res == true) 
						{
							echo '<script>

							swal({

								type: "success",
								title: "¡El Almacén ha sido guardado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "almacenes";

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
									
										window.location = "almacenes";

									}

								});
							

							</script>';
						}
						#
					}
					else
					{
						echo '<script>

						swal({

							type: "error",
							title: "¡El ID de Sucursal no corresponde a uno registrado!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "almacenes";

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
								title: "¡Este nombre y sigla ya se encuentran registrados. Verifique la información!",
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
 							title: "Los campos no pueden ir vacios o llevar caracteres especiales",
 							showConfirmButton: true,
 							confirmButtonText: "Cerrar",
 							closeOnConfirm: false

 							}).then((result)=>{

 								if(result.value){

 									windows.location = "almacenes";
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
					MODIFICAR ALMACENES
	=============================================*/
	static public function ctrEditarAlmacen()
	{
		if (isset($_POST["editarNombre"]))
		{
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarSigla"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarSucursal"])&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editaridAlmacen"])) 
			{

				$oAlmacen_Model = new Almacen_Model;
				$osAlmacen = new Structure_Almacen;

				$oSucursal_Model = new Sucursal_Model;
				$osSucursal = new Structure_Sucursal;

				$verificar = $oAlmacen_Model->Verificar($_POST["editarNombre"],$_POST["editarSigla"]);

				if ($verificar == false) 
				{
					$sucursal = $oSucursal_Model->GetDataSucursal($_POST["editarSucursal"]);

					if ($sucursal != false) 
					{
						foreach ($sucursal as $key => $value) 
						{
							$idSucursal = $value->idSucursal->GetValue();
						}

						$osAlmacen->idAlmacen->SetValue(0);
						$osAlmacen->hash->SetValue($_POST["editaridAlmacen"]);
						$osAlmacen->Nombre->SetValue($_POST["editarNombre"]);
						$osAlmacen->Sigla->SetValue($_POST["editarSigla"]);
						$osAlmacen->idSucursal->SetValue($idSucursal);
						$osAlmacen->estado->SetValue("Activo");

						$res = $oAlmacen_Model->UpdateAlmacen($osAlmacen);

						if ($res == true) 
						{
							echo '<script>

							swal({

								type: "success",
								title: "¡El Almacen ha sido modificado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "almacenes";

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
									
										window.location = "almacenes";

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
							title: "¡El ID de Sucursal no corresponde a uno registrado!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "almacenes";

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
								title: "¡Estos nombres ya estan registrados como almacenes!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "almacenes";

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

 									windows.location = "almacenes";
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

	static public function ctrEliminarAlmacen()
	{
		if (isset($_POST["eliminaridAlmacen"])) 
		{
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["eliminaridAlmacen"])) 
			{
				$oAlmacen_Model = new Almacen_Model;

				$idAlmacen = $_POST["eliminaridAlmacen"];

				$res = $oAlmacen_Model->DeleteAlmacen($idAlmacen);

				if ($res) 
				{
					echo '<script>

						swal({

							type: "success",
							title: "¡El Almacén ha dado de baja correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "almacenes";

							}

						});
					

						</script>';
				}
				else
				{
					echo '<script>

						swal({

							type: "error",
							title: "¡El id no corresponde a un Almacén!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "almacenes";

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

 									windows.location = "almacenes";
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

	static public function ctrActivarAlmacen()
	{
		if (isset($_POST["activaridAlmacen"])) 
		{
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["activaridAlmacen"])) 
			{
				$oAlmacen_Model = new Almacen_Model;

				$idAlmacen = $_POST["activaridAlmacen"];

				$res = $oAlmacen_Model->ActiveAlmacen($idAlmacen);

				if ($res) 
				{
					echo '<script>

						swal({

							type: "success",
							title: "¡El Almacén ha Activado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "almacenes";

							}

						});
					

						</script>';
				}
				else
				{
					echo '<script>

						swal({

							type: "error",
							title: "¡El id no corresponde a un Almacén!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "almacenes";

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

 									windows.location = "almacenes";
 								}


 							});

 					</script>
 				';
			}
		}
	}


}



?>