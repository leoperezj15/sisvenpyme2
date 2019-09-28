<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
                     
class Structure_Cliente
{

 	public $idCliente;
 	public $hash;
 	public $direccion;
 	public $zona;
 	public $tel_fijo;
 	public $tel_celular;
 	public $fecha_reg;
 	public $estado; 
 
    function __construct()
    { 
 		$this->idCliente = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->direccion = new Field("varchar");
 		$this->zona = new Field("varchar");
 		$this->tel_fijo = new Field("varchar");
 		$this->tel_celular = new Field("varchar");
 		$this->fecha_reg = new Field("datetime");
 		$this->estado = new Field("enum");
	}
}
                
?>