<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @version     1.0
 */
                
require_once "field.inc";


                     
class Structure_Marca
{

 	public $idMarca;
 	public $hash;
 	public $nombre;
 	public $descripcion;
 	public $estado;
 
    function __construct()
    { 
 		$this->idMarca = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->nombre = new Field("varchar");
 		$this->descripcion = new Field("varchar");
 		$this->estado = new Field("enum");

	}
}
                
?>