<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
                     
class Structure_Modulo
{

 	public $idModulo;
 	public $hash;
 	public $nombre;
 	public $estado; 
 	public $icono;
 
    function __construct()
    { 
 		$this->idModulo = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->nombre = new Field("varchar");
 		$this->estado = new Field("enum");
 		$this->icono = new Field("varchar"); 
	}
}
                
?>