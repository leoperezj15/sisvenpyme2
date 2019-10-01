<?php

date_default_timezone_set('America/La_Paz');

require "../model/Almacen.Model.php";
require "../model/Sucursal.Model.php";
require "../model/Rol.Model.php";
require "../model/RolModulo.Model.php";
require "../model/Objeto.Model.php";
require "../model/Empleado.Model.php";
require "../model/Usuario.Model.php";
require "../model/Venta.Model.php";
require "../model/Cliente.Model.php";
require "../model/Modelo.Model.php";
require "../model/SubCategoria.Model.php";
require "../model/Producto.Model.php";
require "../model/data/transaction.inc";

$content = "";

if ( isset($_POST["fn"]) )
{
	$fn = $_POST["fn"];

	switch ($fn) 
	{
		/**
		 * @abstract función para listar Almacen Por Sucursal
		 * @param idSucursal
		 * @return list Sucursal
		 */
		case 'AlmacenPorSucursal':
			//lista de modelo por marca
			$idSucursal = intval($_POST["idSucursal"]); // hash Categoria

			if(isset($_POST["idSucursal"]))
			{
			    if(!empty($_POST["idSucursal"]))
			    {

			        $oAlmacen_Model = new Almacen_Model;

			        $listaAlmacen = $oAlmacen_Model->listarAlmacenPorSucursal($idSucursal);

			        $selectAlmacen = "
			        <label for='almacen'>Almacen</label>
			        
			            <select name='compra_add_almacen' id='almacen' class='form-control input-sm'>";
			        foreach ($listaAlmacen as $item2) 
			        {
			            $selectAlmacen .= "<option value='". $item2->idAlmacen->GetValue() ."'>". $item2->nombre->GetValue() ."</option>";
			        }
			        $selectAlmacen .= "</select>";

			        $content = $selectAlmacen;

			    }
			}

		break;
		/** 
 		 * @abstract función para listar Modelo por Marca
		 * @param idMarca
		 * @return list Modelo
		*/
		case 'ModeloPorMarca':
			//lista de modelo por marca
			$idMarca = intval($_POST["idMarca"]); // hash Categoria

			if(isset($_POST["idMarca"]))
			{
			    if(!empty($_POST["idMarca"]))
			    {
			        $oModelo_model = new Modelo_Model;

			        $listaModelo = $oModelo_model->GetModeloForMarca($idMarca);

			        $selectModelo = "
			        <label for='Modelo'>Módelo</label>
			        
						<select name='p_a_modelo' id='p_a_modelo' class='form-control input-sm'>
							<option value='0'>Selecione el modelo</option>";
			        foreach ($listaModelo as $item2) 
			        {
			            $selectModelo .= "<option value='".$item2->idModelo->GetValue()."'>". $item2->model->GetValue() ."</option>";
			        }
			        $selectModelo .= "</select>";

			        $content = $selectModelo;

				}
				else
				{
					$selectModelo = "
						<label for='Modelo'>Módelo</label>
						
						<select name='p_a_modelo' id='p_a_modelo' class='form-control input-sm'>
							<option value='0'>Selecione la Marca</option>
						</select>";

						$content = $selectModelo;
				}
			}
		break;

		/**
		 * 
		 */
		case 'SubCategoriaPorCategoria':

			$idCategoria = intval($_POST["idCategoria"]);

			if(isset($_POST["idCategoria"]))
			{
				if(!empty($_POST["idCategoria"]))
				{
					$oSubCategoria = new SubCategoria_Model;

					$listaSubCategoria = $oSubCategoria->GetListSubCategoriaByCategoria($idCategoria);

					// echo '<pre>';
					// print_r($listaSubCategoria);
					// echo '</pre>';
					// return;

					$selectSubCategoria = "
					<label for='p_a_sub_categoria'>Sub Categoria</label>
					
						<select name='p_a_sub_categoria' id='p_a_sub_categoria' class='form-control input-sm'>
						
							<option value='0'>Selecione una sub-categoria</option>";
					foreach ($listaSubCategoria as $item2) 
					{
						$selectSubCategoria .= "<option value='".$item2->idsubCategoria->GetValue()."'>". $item2->nombre->GetValue() ."</option>";
					}
					$selectSubCategoria .= "</select>";

					$content = $selectSubCategoria;

				}
				else
				{
					$selectSubCategoria = "
						<label for='p_a_sub_categoria'>Sub Categoria</label>
						
						<select name='p_a_sub_categoria' id='p_a_sub_categoria' class='form-control input-sm'>
							<option value='0'>Selecione la Marca</option>
						</select>";

						$content = $selectSubCategoria;
				}
			}
		break;
		case 'SavePedido':
			$oUtil  = new Util;

			$oTransaction = new transaction;

			$oTransaction->StartTransaction();

			$nom 	= $oUtil->toISO($_POST["nom"]);
			$ape    = $oUtil->toISO($_POST["ape"]);
			$ema    = $_POST["ema"];
			$tel    = $_POST["tel"];

			$fecha  = date("Y-m-d");
			$hora   = date("H:i:s");	

			$oRN_Producto	= new RN_Producto;
			$oRN_Cliente 	= new RN_Cliente;
			$oRN_Pedido		= new RN_Pedido;
			$oRN_PedidoItem = new RN_PedidoItem;

			$osCliente	= new Structure_Cliente;

			$osCliente->idCliente->SetValue(0);
			$osCliente->hash->SetValue("");
			$osCliente->fechaRegistro->SetValue($fecha);
			$osCliente->horaRegistro->SetValue($hora);
			$osCliente->nombre->SetValue($nom);
			$osCliente->apellido->SetValue($ape);
			$osCliente->email->SetValue($ema);
			$osCliente->telefono->SetValue($tel);	
			$osCliente->estado->SetValue("Activo");

			$idCliente = $oRN_Cliente->Save($osCliente);

			$osPedido	= new Structure_Pedido;

			$osPedido->idPedido->SetValue(0);
			$osPedido->hash->SetValue("");
			$osPedido->fecha->SetValue($fecha);
			$osPedido->hora->SetValue($hora);
			$osPedido->idCliente->SetValue($idCliente);
			$osPedido->estadoPedido->SetValue("Pago Pendiente");
			$osPedido->estado->SetValue("Activo");

			$idPedido = $oRN_Pedido->Save($osPedido);

			$idItem   = false;

			if ( isset($_SESSION["lista"]) ){
				$lista = $_SESSION["lista"];


				foreach ($lista as $fila) {

					$hashProd = $fila["hash"];

					$oProducto = $oRN_Producto->GetData($hashProd);
					$idProducto	= $oProducto->idProducto->GetValue();

					$osPedidoItem = new Structure_PedidoItem;

					$osPedidoItem->idPedido->SetValue($idPedido);
					$osPedidoItem->idProducto->SetValue($idProducto);
					$osPedidoItem->precio->SetValue($fila["precio"]);
					$osPedidoItem->cantidad->SetValue($fila["cantidad"]);
					$osPedidoItem->estado->SetValue("Activo");

					$idItem = $oRN_PedidoItem->Save($osPedidoItem);
				}
			}

			if ( $idCliente != false and $idPedido != false and $idItem != false )
			{
				$oTransaction->Commit();
			}else{
				$oTransaction->Rollback();
			}
			break;

		case "MostrarProductosPorPagina":
			$nroPag= $_POST["pagina"];

			$oRN_Producto = new RN_Producto;

			$hashCategoria= $_SESSION["hCat"];

			$total = $oRN_Producto->GetTotalProductsByCategoria($hashCategoria);
			$lista = $oRN_Producto->GetListByCategoria($hashCategoria, $nroPag);

			$datos = "";

			$i = 0;

			$can = 2; // Cantidad de filas a mostrar por página

			$totalMostrados = $nroPag * $can; 


			foreach ($lista as $producto) {
				$i++;


				$datos .= "<div>". $producto->nombre->GetValue() . "</div>";
			}

			if ($totalMostrados < $total){
				$nextPage = $nroPag + 1;
				$datos .= "<div style='width:300px; height:40px; line-height:40px; border:1px solid #777777; border-radius:5px;' onclick='Mostrar(". $nextPage .")' id='btn-" . $nroPag."'>Mostrar mas registros</div>";
			}

			$content = $datos;

			break;

		case 'PermisosRoles':
			if (isset($_POST['idRol']) && $_POST['idRol'] != '') 
			{
				$idRol = intval($_POST['idRol']);

				$oRolModulo_model = new RolModulo_Model;

				$oObjeto_Model = new Objeto_Model;

				$res = $oRolModulo_model->GetListByRol($idRol);

				$content = "
				<table class='table table-bordered box-solid bg-green-gradient' width='100%'>
				    <tr>
				        <th>Módulo</th>
				        <th>Objetos</th>
				    </tr>
				    ";//<tr><td colspan='2' style='height:2px;'></td></tr>

				$cad = "";
				$i=0;
                foreach($res as $item)
                {
                	$i++;
                    $idModulo = $item->Modulo->idModulo->GetValue();
                    $modulo = $item->Modulo->nombre->GetValue();
                    
                    $listaObjetos = $oObjeto_Model->GetListByModulo($idModulo);
                    $cad2 = "";
                    
                    // if ($i > 1) 
                    // {
                    // 	$content .= "<tr><td colspan='2' style='height:2px; background:#ABD9F1'></td></tr>";
                    // }

                    foreach($listaObjetos as $item2)
                    {
                    	$objeto = "<span class='badge bg-light-blue'><i class='".$item2->imagen->GetValue()."'></i></span>".$item2->nombre->GetValue()."";
						if ($cad2 != "") $cad2 .= "<br>";
						$cad2 .= $objeto;


                    }

                    $content .= "
				    <tr>
				        <td>". $modulo ."</td>
				        <td>". $cad2 ."</td>
				    </tr>";

                }
                $content .= "</table>";




				
			}
			else
			{
				$content = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
                Se tiene un error el proceso de la información de los roles. Contacte al Administrador.
              </div>';
			}
			break;

		case 'SaveUsuario':

			if (isset($_POST['nombre'])) 
			{
				//recuperando variables del envio de ajax
				$nombre = $_POST["nombre"];
				$apaterno = $_POST["apaterno"];
				$amaterno = $_POST["amaterno"];
				$fecha = $_POST["fecha"];
				$ci = $_POST["ci"];

				$username = $_POST["username"];
				$password = "Miempresa2019@";//contraseña génerica para laprimera vez el usuario debera de cambiar la contraseña
				$alias = $_POST["alias"];
				$email = $_POST["email"];
				$rol = $_POST["rol"];
				//realisando un filtadro de las variables
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombre)&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $apaterno)&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $amaterno)&&
				preg_match('/^[0-9]+$/', $ci)&&
				preg_match('/^[a-zA-Z0-9]+$/', $username)&&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $alias)&&
				filter_var($email, FILTER_VALIDATE_EMAIL)&&
				preg_match('/^[0-9]+$/', $rol)
				)
				{
					//Verificamos si la persona es mayor de edad
					$f1 = new DateTime($fecha);
				    $f2 = new DateTime("now");
				 
				    $diferencia =  $f1->diff($f2);

				    if ($diferencia->format("%y") >= 18) 
				    {
				    	//verificar si exiten usuarios con el ci

						$oEmpleado = new Empleados_Model;

						$empleado = $oEmpleado->VerificarEmpleado(base64_encode($ci));

						//Respuesta empleado preguntamos si es verdadero o falso
						if ($empleado==false) 
						{
							//verificamos que el usuario no este registrado

							$oUsuario = new Usuario_Model;

							$usuario = $oUsuario->VerificarUsername($username);

							if ($usuario==false) 
							{
				
						        //Instaciamos a Transaction quien válidad si se realiza o no las transacciones
						        $oTransaction = new transaction;
								$oTransaction->StartTransaction();

								//Instanciamos las estructuras
								$osEmpleado = new Structure_Empleado;

								$osEmpleado->idEmpleado->SetValue(0);
								$osEmpleado->hash->SetValue("");
								$osEmpleado->nombre->SetValue($nombre);
								$osEmpleado->a_paterno->SetValue($apaterno);
								$osEmpleado->a_materno->SetValue($amaterno);
								$osEmpleado->fecha_nac->SetValue(date("Y-m-d H:i:s"));
								$osEmpleado->ci->SetValue($ci);
								$osEmpleado->fecha_ingreso->SetValue(date("Y-m-d H:i:s"));
								$osEmpleado->fecha_despido->SetValue("Null");
								$osEmpleado->condicion->SetValue("CU");
								$osEmpleado->estado->SetValue("Activo");

								$idEmpleado = $oEmpleado->SaveEmpleado($osEmpleado);

								if ($idEmpleado!=false) 
								{
									$osUsuario = new Structure_Usuario;

									$osUsuario->idUsuario->SetValue(0);
									$osUsuario->hash->SetValue("");
									$osUsuario->username->SetValue($username);
									$osUsuario->password->SetValue($password);
									$osUsuario->alias->SetValue($alias);
									$osUsuario->email->SetValue($email);
									$osUsuario->idRol->SetValue($rol);
									$osUsuario->estado->SetValue("Activo");
									$osUsuario->idEmpleado->SetValue($idEmpleado);

									$save_usuario = $oUsuario->SaveUsuario($osUsuario);

									//Si las dos transacciones en empleado y usuario fueron correctas
									//Se procede a hacer un commit de lo contrario se realiza un rollback

									if ( $idEmpleado != false and $save_usuario != false)
									{
										$oTransaction->Commit();
									}else
									{
										$oTransaction->Rollback();
									}

									if ($save_usuario == true) 
									{

										echo "
								        <script>
								            swal({
												type: 'success',
												title: '¡El Usuario se ha creado correctamente!',
												showConfirmButton: true,
												confirmButtonText: 'Cerrar'

											}).then(function(result){

												if(result.value){
												
													window.location = 'usuarios';

												}

											});
								        </script>";
								        return;
									}
									else
									{
										echo "
								        <script>
								            swal({
								                position: 'top',
								                type: 'error',
								                title: 'Error, no se puedo guardar el usuario',
								                showConfirmButton: false,
								                timer: 1500
								            });
								        </script>";
								        return;
									}

								}
								else
								{
									echo "
							        <script>
							            swal({
							                position: 'top',
							                type: 'error',
							                title: 'Error, no se puedo guardar al empleado',
							                showConfirmButton: false,
							                timer: 1500
							            });
							        </script>";
							        return;
								}



							}
							else
							{
								echo "
						        <script>
						            swal({
						                position: 'top',
						                type: 'error',
						                title: 'Ese usuario ya se encuentra Registrado',
						                showConfirmButton: false,
						                timer: 1500
						            });
						        </script>";
						        return;
							}
							
						}
						else
						{
							echo "
					        <script>
					            swal({
					                position: 'top',
					                type: 'error',
					                title: 'El ci ya esta registrado',
					                showConfirmButton: false,
					                timer: 1500
					            });
					        </script>";
					        return;
						}
					
				        
				    } 
				    else 
				    {
				        echo "
				        <script>
				            swal({
				                position: 'top',
				                type: 'error',
				                title: 'Es menor de edad',
				                showConfirmButton: false,
				                timer: 1500
				            });
				        </script>";
				        return;
				    }			

				}
				else
				{
					echo "
			        <script>
			            swal({
			                position: 'top',
			                type: 'error',
			                title: 'No son permitidos los caracteres especiales en las entradas',
			                showConfirmButton: false,
			                timer: 1500
			            });
			        </script>";
			        return;
				}

			}
			else
			{

			}

			break;

		case 'ReporteVentas':


			if (isset($_POST['rango_fechas'])&&isset($_POST['usuario'])&&isset($_POST['cliente'])) 
			{
				if (preg_match('/^[0-9@ -]+$/', $_POST["rango_fechas"])&&
					preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"])&&
					preg_match('/^[a-zA-Z0-9]+$/', $_POST["cliente"])
					) 
				{
					$idUsuario = $_POST['usuario'];
					$idCliente = $_POST['cliente'];
					$validar_fecha = explode("@", $_POST["rango_fechas"]);
					$fecha_inicial = $validar_fecha[0];
					$fecha_final = $validar_fecha[1];

					$f1 = strtotime($fecha_inicial);
					$f2 = strtotime($fecha_final);
					$f3 = strtotime("now");

					if ($f1>$f3) 
					{
						echo "
				        <script>
				            swal({
				                position: 'top',
				                type: 'error',
				                title: 'La fecha Inical sobrepasa a la fecha Actual',
				                showConfirmButton: false,
				                timer: 1500
				            });
				        </script>";
				        return;
					}
					else
					{

						if ($f2>$f3) 
						{
							echo "
					        <script>
					            swal({
					                position: 'top',
					                type: 'error',
					                title: 'La fecha Final sobrepasa a la fecha Actual',
					                showConfirmButton: false,
					                timer: 1500
					            });
					        </script>";
					        return;
						}
						else
						{
							if ($idUsuario != "No") 
							{
								$oUsuario = new Usuario_Model;

								$idUsuario = $oUsuario->GetUsuario($idUsuario);

								if ($idUsuario == false) 
								{
									echo "
							        <script>
							            swal({
							                position: 'top',
							                type: 'error',
							                title: 'El usuario no corresponde a uno valido',
							                showConfirmButton: false,
							                timer: 1500
							            });
							        </script>";
							        return;
								}	
								
							}
							if ($idCliente != "No") 
							{
								$oCliente = new Cliente_Model;

								$idCliente = $oCliente->GetCliente($idCliente);

								if ($idCliente == false) 
								{
									echo "
							        <script>
							            swal({
							                position: 'top',
							                type: 'error',
							                title: 'El Cliente no corresponde a uno válido',
							                showConfirmButton: false,
							                timer: 1500
							            });
							        </script>";
							        return;
								}

							}

							$respuesta = "ok|".$fecha_inicial."|".$fecha_final."|".$idUsuario."|".$idCliente;
							echo $respuesta;
							
						}
					}
				}
				else
				{
					echo "
			        <script>
			            swal({
			                position: 'top',
			                type: 'error',
			                title: 'No se cumple la condicion al insertar los datos',
			                showConfirmButton: false,
			                timer: 1500
			            });
			        </script>";
			        return;

				}
				//$validar_fecha = explode("/",$_POST["editarFechaNac"]);

				//$fecha_valida = "".$validar_fecha[2]."-".$validar_fecha[1]."-".$validar_fecha[0]."";
			}
			else
			{
				echo "
		        <script>
		            swal({
		                position: 'top',
		                type: 'error',
		                title: 'no existen',
		                showConfirmButton: false,
		                timer: 1500
		            });
		        </script>";
		        return;
			}

			break;
		case 'ChangePass':

			if(isset($_POST['username'])&&isset($_POST['old_pass'])&&isset($_POST['new_pass'])&&isset($_POST['confir_new_pass']))
			{
				if(	preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%.ñÑ])[0-9A-Za-zñÑ!@#$%.]{8,16}$/', $_POST['new_pass'])&&
					preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%.ñÑ])[0-9A-Za-zñÑ!@#$%.]{8,16}$/', $_POST['confir_new_pass'])&&
					$_POST['new_pass'] == $_POST['confir_new_pass'])
				{
					$username = base64_encode($_POST['username']);
					$old_pass =  base64_encode($_POST['old_pass']);
					$new_pass =  base64_encode($_POST['new_pass']);
					$confir_new_pass =  base64_encode($_POST['confir_new_pass']);

					$oUsuario_Model = new Usuario_Model;
                
					$login = $oUsuario_Model->VerificarLogin($username, $old_pass);
					
					if($login != Null)
					{
						$change_pass = $oUsuario_Model->ChangePass($username,$new_pass);
						
						if ($change_pass == true) 
						{
							echo "
							<script>
								swal({
									position: 'top',
									type: 'success',
									title: 'La contraseña se actualizo correctamente',
									showConfirmButton: false,
									timer: 1500
								});
							</script>";
							return;
						}
						else
						{
							echo "
							<script>
								swal({
									position: 'top',
									type: 'error',
									title: 'La contraseña no se pudo modificar',
									showConfirmButton: false,
									timer: 1500
								});
							</script>";
							return;
						}
						
					}
					else
					{
						echo "
						<script>
							swal({
								position: 'top',
								type: 'error',
								title: 'La contraseña ingresada es incorrecta',
								showConfirmButton: false,
								timer: 1500
							});
						</script>";
						return;
					}

				}
				else
				{
					echo "
					<script>
						swal({
							position: 'top',
							type: 'error',
							title: 'la contraseña no cumple con los requisitos al menos Una Mayuscula, minuscula, número o signo',
							showConfirmButton: false,
							timer: 1500
						});
					</script>";
					return;
				}
				
				
			}
			else
			{
				echo "
		        <script>
		            swal({
		                position: 'top',
		                type: 'error',
		                title: 'no existen',
		                showConfirmButton: false,
		                timer: 1500
		            });
		        </script>";
		        return;
			}

		break;
		/** 
		 * 
		*/
		case 'SaveProducto':
			
			
			if(isset($_POST['nombre']))
			{
				$nombre = $_POST['nombre'];
				$descripcion = $_POST['descripcion'];
				$marca = $_POST['marca'];
				$modelo = $_POST['modelo'];
				$categoria = $_POST['categoria'];
				$subcategoria = $_POST['subcategoria'];
				$codigo = $_POST['codigo'];
				$precio = $_POST['precio'];
				$pais = $_POST['pais'];
				$incremento = $_POST['incremento'];
				$um = $_POST['um'];
				$peso = $_POST['peso'];

				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\/.\- ]+$/', $nombre)&&
					preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\/.\- ]+$/', $descripcion)&&
					preg_match('/^[0-9]+$/', $marca)&&
					preg_match('/^[0-9]+$/', $modelo)&&
					preg_match('/^[0-9]+$/', $categoria)&&
					preg_match('/^[0-9]+$/', $subcategoria)&&
					preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $pais)&&
					filter_var($codigo, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1001000, "max_range" => 1009999)))&&
					filter_var($incremento, FILTER_VALIDATE_INT, array("options" => array("min_range" => 10, "max_range" => 60)))&&
					filter_var($um, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1, "max_range" => 100)))&&
					preg_match('/^[0-9.]+$/', $precio)&&
					preg_match('/^[a-zA-Z0-9 ]+$/', $peso)
				)
				{
					// echo '<pre>';
					// print_r($_POST);
					// echo '</pre>';
					// return;

					//Operacion axiliar para sacar el precio de Venta
					$calculo = ($precio * $incremento) / 100;
					$pventa = $calculo + $precio;

					//verificamos que precio de venta sea mayor al precio 
					if ($pventa > $precio) 
					{
						$oProducto = new Producto_Model;
						$osProducto = new Structure_Producto;

						$verificar_nom = $oProducto->VerificarProducto('nombre',$nombre);
						
						// return;
						if (empty($verificar_nom)) 
						{
							//echo 'no existe el nombre';
							$oProducto1 = new Producto_Model;
							$verificar_cod = $oProducto1->VerificarProducto('codigo',$codigo);
							// echo '<pre>';
							// print_r($verificar_cod);
							// echo '</pre>';
							if (empty($verificar_cod)) 
							{
								$oProducto2 = new Producto_Model;
								$verificar_mod = $oProducto2->VerificarProducto('idModelo',$modelo);
								if (empty($verificar_mod)) {

									
									$osProducto->idProducto->SetValue(0);
									$osProducto->hash->SetValue("");
									$osProducto->nombre->SetValue($nombre);
									$osProducto->descripcion->SetValue($descripcion);
									$osProducto->estado->SetValue("Activo");
									$osProducto->peso->SetValue($peso); 
									$osProducto->madein->SetValue($pais);
									$osProducto->codigo->SetValue($codigo);
									$osProducto->pcompra->SetValue($precio);
									$osProducto->pventa->SetValue($pventa);
									$osProducto->idModelo->SetValue($modelo);
									$osProducto->idsubCategoria->SetValue($subcategoria);
									$osProducto->idunidadMedida->SetValue($um);

									$oProducto = new Producto_Model;

									$res = $oProducto->SaveProducto($osProducto);

									if ($res == true){
										echo "
										<script>
											swal({
												position: 'top',
												type: 'success',
												title: 'El producto se ah guardado correctamente',
												showConfirmButton: false,
												timer: 1500
											});
										</script>";
										return;
									}
									else{
										echo "
										<script>
											swal({
												position: 'top',
												type: 'error',
												title: 'No se pudo guardar el producto',
												showConfirmButton: false,
												timer: 1500
											});
										</script>";
										return;
									}

								}else{
									echo "
									<script>
										swal({
											position: 'top',
											type: 'error',
											title: 'Ya existe un producto asignado al modelo',
											showConfirmButton: false,
											timer: 1500
										});
									</script>";
									return;
								}
								
							}
							else
							{
								echo "
								<script>
									swal({
										position: 'top',
										type: 'error',
										title: 'El código ya existe en un producto',
										showConfirmButton: false,
										timer: 1500
									});
								</script>";
								return;
							}
							
						}
						else{
							echo "
							<script>
								swal({
									position: 'top',
									type: 'error',
									title: 'Ya existe un producto con ese nombre',
									showConfirmButton: false,
									timer: 1500
								});
							</script>";
							return;
						}

					}
					else{
						echo "
						<script>
							swal({
								position: 'top',
								type: 'error',
								title: 'El precio de Venta no puede ser menor al precio de Compra',
								showConfirmButton: false,
								timer: 1500
							});
						</script>";
						return;
					}

					

				}
				else
				{
					echo "
					<script>
						swal({
							position: 'top',
							type: 'error',
							title: 'Error, algunos datos tienen caracteres especiales no permitidos',
							showConfirmButton: false,
							timer: 1500
						});
					</script>";
					return;
				}

			}
			else
			{

			}
		break;
		default:
			# code...
			break;
	}
}
echo $content;

?>