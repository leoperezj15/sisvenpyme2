<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Modulo.inc";
                     
class Structure_Objeto
{

 	public $idObjeto;
 	public $hash;
 	public $nombre;
 	public $imagen;
 	public $nombreControl;
 	public $orden;
 	public $idModulo;
 	public $estado; 

	public $Modulo;
 
    function __construct()
    { 
 		$this->idObjeto = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->nombre = new Field("varchar");
 		$this->imagen = new Field("varchar");
 		$this->nombreControl = new Field("varchar");
 		$this->orden = new Field("int");
 		$this->idModulo = new Field("int");
 		$this->estado = new Field("enum"); 

		$this->Modulo = new Structure_Modulo;
	}
}
                
?>