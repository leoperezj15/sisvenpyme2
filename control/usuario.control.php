<?php 
date_default_timezone_set('America/La_Paz');


require_once "model/Usuario.Model.php";
require_once "model/RolModulo.Model.php";
require_once "model/Objeto.Model.php";


class ControladorUsuarios
{

    /*=============================================
    INGRESO DE USUARIO
    =============================================*/

    static public function ctrIngresoUsuario()
    {

        if (isset($_POST["user"]) && isset($_POST["pass"])) 
        {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["user"]))
            {
                if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%.ñÑ])[0-9A-Za-zñÑ!@#$%.]{8,16}$/', $_POST["pass"])) 
                {
                    $user = base64_encode($_POST["user"]);
                    $pass = base64_encode($_POST["pass"]);
                    
                    $oUsuario_Model    = new Usuario_Model;
                    
                    $oUsuario   = $oUsuario_Model->VerificarLogin($user, $pass);
                    
                    $content = "error|Datos de acceso incorrectos";
                    if ($oUsuario != null)
                    {
                        
                        $idRol  = $oUsuario->idRol->getValue();
                        $rol    = $oUsuario->Rol->nombre->GetValue();
                        //incrementar usuario a la variable de session
                        $idUsuario = $oUsuario->idUsuario->GetValue();
                        $usuario = $oUsuario->username->GetValue();
                        $email = $oUsuario->email->GetValue();
                        $idEmpleado = $oUsuario->idEmpleado->GetValue();
                        //
                        
                        $oRolModulo_model  = new RolModulo_Model;
                        $oObjeto_Model     = new Objeto_Model;
                        
                        $lista = $oRolModulo_model->GetListByRol($idRol);
                        
                        $acl = array();
                        $cad = "";

                        foreach($lista as $item)
                        {
                            $idModulo = $item->idModulo->GetValue();
                            
                            $listaObjetos = $oObjeto_Model->GetListByModulo($idModulo);
                            $cad2 = "";
                            
                            $iObjetos = array();
                            foreach($listaObjetos as $item2){
                                $cad2 .= $item2->nombre->GetValue() . ",";
                                
                                $iObjetos[] = array("idObjeto" => $item2->idObjeto->GetValue(),
                                                    "nombre" => $item2->nombre->GetValue(),
                                                    "nombreControl" =>$item2->nombreControl->GetValue(),
                                                    );

                                $_SESSION["ObjetosValidos"][] = $item2->nombreControl->GetValue();
                            }
                            
                            $iModulos[] = array("idModulo" => $idModulo,
                                                "nombre" => $item->Modulo->nombre->GetValue(),
                                                "icono" => $item->Modulo->icono->GetValue(),
                                                "listaObjetos" => $iObjetos);
                                                
                            $cad .= $item->Modulo->nombre->GetValue() . "(". $cad2 .")";
                        }

                        $usuarioactivo = array(
                            "idUsuario" => $idUsuario,
                            "usuario" => $usuario,
                            "email" => $email,
                        "idEmpleado" => $idEmpleado);

                        $acl = array("idRol" => $idRol,
                                    "nombre" => $rol,
                                    "usuario_activo" => $usuarioactivo,
                                    "listaModulos" => $iModulos);

                        $_SESSION["ACL"] = $acl;

                        
                        $content = "ok|Datos Correctos";
                        echo '<script>

                                    window.location = "inicio";

                                </script>';
                        
                    }
                    else
                    {
                        echo '
                                <script>

                                    swal({

                                        type: "error",
                                        title: "¡Usuario y/o contraseña incorrectos! Intente de nuevo",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"

                                    }).then(function(result){

                                        if(result.value){
                                        
                                            window.location = "inicio";

                                        }

                                    });
                                

                                </script>';
                    }
                }
                else{
                    echo '
                        <script>

                            swal({

                                type: "error",
                                title: "¡La contraseña no cumple con los requisitos mínimos de 8 a 16 caracteres! Intente de nuevo",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"

                            }).then(function(result){

                                if(result.value){
                                
                                    window.location = "inicio";

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
                            title: "¡Usuario inválido, no debe contener caracteres especiales! Intente de nuevo",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = "inicio";

                            }

                        });
                    

                    </script>';
            }
        }
        else
        {
            // echo '<br><div class="alert alert-success">Servicio Activo</div>';
        }
    }

        

    /*=============================================
    REGISTRO DE USUARIO
    =============================================*/

    static public function ctrCrearUsuario()
    {

        if(isset($_POST["nuevoUsuario"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
               preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
               preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

                /*=============================================
                VALIDAR IMAGEN
                =============================================*/

                $ruta = "";

                if(isset($_FILES["nuevaFoto"]["tmp_name"])){

                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*=============================================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                    =============================================*/

                    $directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

                    mkdir($directorio, 0755);

                    /*=============================================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                    =============================================*/

                    if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);                        

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }

                    if($_FILES["nuevaFoto"]["type"] == "image/png"){

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);                     

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);

                    }

                }

                $tabla = "usuarios";

                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array("nombre" => $_POST["nuevoNombre"],
                               "usuario" => $_POST["nuevoUsuario"],
                               "password" => $encriptar,
                               "perfil" => $_POST["nuevoPerfil"],
                               "foto"=>$ruta);

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
            
                if($respuesta == "ok"){

                    echo '<script>

                    swal({

                        type: "success",
                        title: "¡El usuario ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = "usuarios";

                        }

                    });
                

                    </script>';


                }   


            }else{

                echo '<script>

                    swal({

                        type: "error",
                        title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = "usuarios";

                        }

                    });
                

                </script>';

            }


        }


    }

    /*=============================================
    MOSTRAR USUARIOS
    =============================================*/

    static public function ctrMostrarUsuarios()
    {

        $oUsuario_Model = new Usuario_Model;

        $nro = "All";

        $respuesta = $oUsuario_Model->GetListForEmploye($nro);

        return $respuesta;
    }

    /*=============================================
    MOSTRAR USUARIO
    =============================================*/

    static public function ctrMostrarUsuario($_id)
    {

        $oUsuario_Model = new Usuario_Model;

        $nro = $_id;

        $respuesta = $oUsuario_Model->GetListForEmploye($nro);

        return $respuesta;
    }

    /*=============================================
    EDITAR USUARIO
    =============================================*/

    static public function ctrEditarUsuario(){

        if(isset($_POST["editarUsuario"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

                /*=============================================
                VALIDAR IMAGEN
                =============================================*/

                $ruta = $_POST["fotoActual"];

                if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

                    list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*=============================================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                    =============================================*/

                    $directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

                    /*=============================================
                    PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
                    =============================================*/

                    if(!empty($_POST["fotoActual"])){

                        unlink($_POST["fotoActual"]);

                    }else{

                        mkdir($directorio, 0755);

                    }   

                    /*=============================================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                    =============================================*/

                    if($_FILES["editarFoto"]["type"] == "image/jpeg"){

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);                       

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }

                    if($_FILES["editarFoto"]["type"] == "image/png"){

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);                        

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);

                    }

                }

                $tabla = "usuarios";

                if($_POST["editarPassword"] != ""){

                    if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    }else{

                        echo'<script>

                                swal({
                                      type: "error",
                                      title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
                                      showConfirmButton: true,
                                      confirmButtonText: "Cerrar"
                                      }).then(function(result) {
                                        if (result.value) {

                                        window.location = "usuarios";

                                        }
                                    })

                            </script>';

                            return;

                    }

                }else{

                    $encriptar = $_POST["passwordActual"];

                }

                $datos = array("nombre" => $_POST["editarNombre"],
                               "usuario" => $_POST["editarUsuario"],
                               "password" => $encriptar,
                               "perfil" => $_POST["editarPerfil"],
                               "foto" => $ruta);

                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                if($respuesta == "ok"){

                    echo'<script>

                    swal({
                          type: "success",
                          title: "El usuario ha sido editado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result) {
                                    if (result.value) {

                                    window.location = "usuarios";

                                    }
                                })

                    </script>';

                }


            }else{

                echo'<script>

                    swal({
                          type: "error",
                          title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result) {
                            if (result.value) {

                            window.location = "usuarios";

                            }
                        })

                </script>';

            }

        }

    }

    /*=============================================
    BORRAR USUARIO
    =============================================*/

    static public function ctrBorrarUsuario(){

        if(isset($_GET["idUsuario"])){

            $tabla ="usuarios";
            $datos = $_GET["idUsuario"];

            if($_GET["fotoUsuario"] != ""){

                unlink($_GET["fotoUsuario"]);
                rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

            }

            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

            if($respuesta == "ok"){

                echo'<script>

                swal({
                      type: "success",
                      title: "El usuario ha sido borrado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                      }).then(function(result) {
                                if (result.value) {

                                window.location = "usuarios";

                                }
                            })

                </script>';

            }       

        }

    }

     /*=============================================
    CAMBIAR LA CONTRACEÑA
    =============================================*/

    static public function ctnChangePassword()
    {
        
    }


}

?>