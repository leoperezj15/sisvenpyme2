<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2019
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Rol.inc";
require_once "Empleado.inc";
                     
class Structure_Usuario
{

 	public $idUsuario;
 	public $hash;
 	public $username;
 	public $password;
 	public $alias;
 	public $email;
 	public $idRol;
 	public $estado;
 	public $idEmpleado; 

	public $Rol;
	public $Empleado;
 
    function __construct()
    { 
 		$this->idUsuario = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->username = new Field("varchar");
 		$this->password = new Field("blob");
 		$this->alias = new Field("varchar");
 		$this->email = new Field("varchar");
 		$this->idRol = new Field("int");
 		$this->estado = new Field("enum");
 		$this->idEmpleado = new Field("int");

		$this->Rol = new Structure_Rol;
		$this->Empleado = new Structure_Empleado;
	}
}
                
?>