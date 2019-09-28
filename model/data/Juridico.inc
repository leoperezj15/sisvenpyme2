<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Cliente.inc";

                     
class Structure_Juridico
{

 	public $idCliente;
 	public $razon_social;
 	public $rpte_legal;
 	public $nit;

    Public $Cliente;
 
    function __construct()
    { 
 		$this->idCliente = new Field("int", true);
 		$this->razon_social = new Field("varchar");
 		$this->rpte_legal = new Field("varchar");
 		$this->nit = new Field("varchar");

        $this->Cliente = new Structure_Cliente;
	}
}
                
?>