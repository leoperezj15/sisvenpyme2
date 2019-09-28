<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufuß
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Rol.inc";
require_once "Modulo.inc";
                     
class Structure_RolModulo
{

 	public $idRol;
 	public $idModulo;
 	public $hash;
 	public $estado; 

	public $Rol;
	public $Modulo;
 
    function __construct()
    { 
 		$this->idRol = new Field("int", true);
 		$this->idModulo = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->estado = new Field("enum"); 

		$this->Rol = new Structure_Rol;
		$this->Modulo = new Structure_Modulo;
	}
}
                
?>