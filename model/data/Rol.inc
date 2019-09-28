<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufuß
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
                     
class Structure_Rol
{

 	public $idRol;
 	public $hash;
 	public $nombre;
 	public $estado; 
 
    function __construct()
    { 
 		$this->idRol = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->nombre = new Field("varchar");
 		$this->estado = new Field("enum"); 
	}
}
                
?>