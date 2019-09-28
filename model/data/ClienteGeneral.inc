<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
                     
class Structure_ClienteGeneral
{

 	public $idCliente;
 	public $nombreCompleto;
 	public $nroDocumento;
 	public $direccion;
 	public $celular;
    public $tipoCliente; 
 
    function __construct()
    { 
 		$this->idCliente = new Field("int", true);
 		$this->nombreCompleto = new Field("varchar");
        $this->nroDocumento = new Field("varchar");
 		$this->direccion = new Field("varchar");
 		$this->celular = new Field("varchar");
 		$this->tipoCliente = new Field("varchar");
	}
}
                
?>